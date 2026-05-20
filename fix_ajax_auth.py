#!/usr/bin/env python3
"""
Hardens admin-only AJAX endpoints in functions-ajax.php:
  1. Removes wp_ajax_nopriv_ registrations for admin-only handlers
  2. Injects current_user_can('manage_options') guard at top of each function body
"""

import re

FILE = "includes/lib/functions-ajax.php"

# Admin-only functions that must NOT be callable by unauthenticated users.
# These cover: destructive writes, data deletion, API key writes, config writes,
# custom JS injection, cloning, user-data reads, and lead data reads.
ADMIN_ONLY_FUNCS = [
    "SQBQuizAnswerDeleteByQuestionIdAjax",
    "SQBSaveDapBlockingQuizAjax",
    "SQBQuizUpdateStatusById",
    "SqbSaveFbApiKeyAjax",
    "SqbSaveQuickEmailVerificationSettingsAjax",
    "SqbLoadQuestionAnswerReportAjax",
    "sqbLoadReportsData",
    "sqb_empty_stats_table",
    "sqb_save_funnel_name",
    "sqb_save_funnel_questions",
    "sqb_save_funnel_answers",
    "sqb_save_funnel_templates",
    "SQBSaveQuizAjax",
    "sqb_save_question",
    "sqb_save_answer",
    "sqb_save_matrix_background_options",
    "sqb_save_quiz_settings",
    "sqb_filter_lead_data",
    "sqb_save_update_fb_tracking_id",
    "sqb_delete_customjs",
    "sqb_update_custom_js",
    "sqb_save_customjs",
    "sqb_load_custom_js",
    "sqb_load_custom_js_by_id",
    "sqb_save_quiz_notification",
    "sqb_save_pdf_html",
    "SQBLoadUsersByFilter",
    "sqbCloneLeaderboardByIdAjax",
    "sqb_clone_pdfContent_by_id",
    "sqbCloneQuizByIdAjax",
    "sqb_clone_outcome",
    "sqb_clone_question",
    "SQBSaveQuizCategoryAjax",
    "SQBQuizCategoryDeleteAjax",
    "sqbSaveOutcomeGameAnimation",
    "sqbSaveAdvanced",
    "sqbSaveCategoryAdvancedRule",
    "sqbSaveOutcomeRank",
    "sqbSaveCategoryAdvanced",
    "SqbSaveFormula",
    "SqbDeleteFormula",
    "sqb_save_funnel_quiz_data",
    "sqb_save_social_share",        # SqbSaveSocialShareAjax renamed
    "SqbSaveSocialShareAjax",
    "sqb_save_quiz_category",
    "sqb_quiz_category_delete",
    "sqb_load_search_answers_data",
    "sqbLoadSearchAnswersData",
    "sqb_load_search_answers",
    "sqbLoadSearchAnswers",
]

AUTH_GUARD = "    if (!current_user_can('manage_options')) { wp_send_json_error('Unauthorized', 403); }\n"

with open(FILE, "r", encoding="utf-8") as f:
    content = f.read()

lines = content.split("\n")

# ── Step 1: Remove wp_ajax_nopriv_ lines for admin-only functions ──────────────
nopriv_pattern = re.compile(
    r"""add_action\s*\(\s*['"]wp_ajax_nopriv_([^'"]+)['"]\s*,\s*['"]([^'"]+)['"]\s*\)"""
)

new_lines = []
removed_nopriv = []
for line in lines:
    m = nopriv_pattern.search(line)
    if m:
        action_func = m.group(2)
        if action_func in ADMIN_ONLY_FUNCS:
            removed_nopriv.append(line.strip())
            continue  # drop this line
    new_lines.append(line)

lines = new_lines

# ── Step 2: Inject auth guard at start of each admin-only function body ────────
func_pattern = re.compile(
    r"""^(function\s+({funcs})\s*\([^)]*\)\s*\{{)""".format(
        funcs="|".join(re.escape(f) for f in ADMIN_ONLY_FUNCS)
    )
)

new_lines = []
injected = []
i = 0
while i < len(lines):
    line = lines[i]
    m = func_pattern.match(line.strip())
    if m:
        func_name = m.group(2)
        # Find opening brace on this line or next
        stripped = line.rstrip()
        if stripped.endswith("{"):
            new_lines.append(line)
            # Check that next line doesn't already have the guard
            if i + 1 < len(lines) and "current_user_can" not in lines[i + 1]:
                new_lines.append(AUTH_GUARD.rstrip("\n"))
                injected.append(func_name)
        else:
            new_lines.append(line)
    else:
        new_lines.append(line)
    i += 1

content = "\n".join(new_lines)

with open(FILE, "w", encoding="utf-8") as f:
    f.write(content)

print(f"Removed {len(removed_nopriv)} nopriv registrations:")
for r in removed_nopriv:
    print(f"  - {r}")

print(f"\nInjected auth guard into {len(injected)} functions:")
for fn in injected:
    print(f"  + {fn}()")
