<?php 



function get_openAI_prompts_array(){

	$prompt_data = array(

		'question_prompt_editable' => ' -  %%TITLE%%\n\n\Total questions: %%TOTAL%% questions.%%TYPE%%\n%%OUTCOME_CONTENT%%\n%%OUTCOME_TITLES%%%%QTYPE%%\n\nLanguage: Response in %%QUIZ_LANG%% %%ADDITIONAL%% \n\n<span>%%HARDCODE_TEXT%%</span>',

		'question_prompt_editable_ideal' => ' -  %%TITLE%%\n\nGive me back ideal number of questions and relevant answers for this keeping in mind these criteria / rules:\n\nHere are the rules:\n\nRule 1: I want only these types of questions:\n%%AI_QTYPE%%%%QTYPE%%\n\nRule 2:\nMax limit of questions: 15 \n\nRule 3:\nLanguage: Response in %%QUIZ_LANG%%\n%%ADDITIONAL%% \n\nRule 4:\nKeep in mind these are my outcomes\n%%OUTCOME_TITLES%%\n\n<span>%%HARDCODE_TEXT%%</span>',

		'question_prompt_survey_editable' => 'Goal: %%ADDITIONAL%% \n\n\Here is what my product does:\n%%SURVEYDESCRIBE%%\n\nSurvey Title: %%TITLE%%\n\nInstructions:\nLanguage: Response in %%QUIZ_LANG%%\nNeed survey questions and answers.\nTotal questions: %%TOTAL%%\nIMPORTANT: Follow this question order in the response.%%TYPE%%\n%%OUTCOME_CONTENT%%\n%%QTYPE%%<span>%%HARDCODE_TEXT%%</span>',

		'question_prompt_survey_editable_ideal' => 'Goal: %%ADDITIONAL%% \n\n\Here is what my product does:\n%%SURVEYDESCRIBE%%\n\nSurvey Title: %%TITLE%%\n\nGive me back ideal number of questions and relevant answers for this keeping in mind these criteria / rules\n\nInstructions:\nLanguage: Response in %%QUIZ_LANG%%\nNeed survey questions and answers.\n\nIMPORTANT: Follow this question order in the response.\n%%OUTCOME_CONTENT%%\n\nI want only these types of questions:%%AI_QTYPE%%\n\n<span>%%HARDCODE_TEXT%%</span>',

		'question_prompt' => 'Don\'t add question number.\nType names in this format - %%SELECTED_TYPE%%.\nSort questions by - %%SELECTED_TYPE%%.\n\nNeed quiz content in JSON format with easy copy code button. Use these variables in JSON: \n%%JSON_CODE%%',

		'question_prompt_scoring' => 'Don\'t add question number.\nType names in this format - %%SELECTED_TYPE%%.\nSort questions by - %%SELECTED_TYPE%%.\nNeed outcome titles in the right order based on low to high rank \n\nNeed entire quiz content in one JSON CODE response. It should be in JSON format with easy copy code button. Use these variables in JSON: \n%%JSON_CODE%%',

		'question_prompt_survey' => 'Don\'t add question number.\nType names in this format - %%SELECTED_TYPE%%.\nSort questions by - %%SELECTED_TYPE%%.\n\nNeed quiz content in JSON format with easy copy code button. Use these variables in JSON: \n%%JSON_CODE%%',

		'questions_personality_prompt_json' => '[{\n"question": "",\n"type": "rating",\n"min-max-text" :[] \n"answers": [{"answer" : "1","outcome":""},...,{"answer" : "5","outcome":""}],\n{\n"question": "",\n"type": "single/multiple/open",\n"answers": [{"answer" : "","outcome":"","points":"","correct":"true"}]\n}\n]',

		'questions_survey_prompt_json' => '[{\n"question": "",\n"type": "",\n"answers": [{"answer" : ""}]\n},\n{\n"question": "",\n"type": "rating",\n"min-max-text" :[] \n"answers": [{"answer" : "1","answer" : "2"...,"answer" : "5"}]\n}\n]',

		'questions_scoring_prompt_json' => '{"questions" :[\n {\n "question": "",\n "type": "",\n "answers": [{"answer" : "","points":"","correct":"true"}]\n },\n {\n "question": "",\n "type": "",\n "answers": [{"answer" : "","points":"","correct":"true"}]\n }\n ],\n "outcomes": [\n {\n "outcome_title": "Outcome 1",\n }\n ]\n }',

		'title_prompt_personality' => 'I would like to create a personality quiz. \nHere is the quiz description: [topic]%%LANG_MSG%%\n\nHelp me generate 10 engaging quiz titles. \n\Draw inspiration from the following examples:\nWhat type of (topic) is right for you?\nHow much do you know about (topic)\nWhich (topic) are you?\nWhat is your (topic) style?\nWhat kind of (topic) are you?\nWhat type of (topic) should you create?\n',

		'title_prompt_scoring' => 'I would like to create a scoring quiz. [topic]. \nHere is the quiz description: [topic]%%LANG_MSG%%\n\nHelp me generate 10 engaging quiz titles. \n\Draw inspiration from the following examples:\nHow much do you actually know about (topic)?\nWhat type of (topic) is right for you?\nHow well do you know (topic)?\n',

		'title_prompt_survey' => '[topic]%%LANG_MSG%%\n\nHere\'s what my product does:\n%%PRODUCT_DETAIL%%\n\nNeed 10 survey title ideas.\nGuidelines:\nGot a minute?\nWe\'re listening!\nCan you help?\nWe want to hear you!\nYour feedback matters\n',

		'outcome_prompt' => ' - "%%TITLE%%"\n\nCriteria:\n%%QUIZ_LANG%%\n%%ADDITIONAL%%\n\nDesired Outcomes:\n1) Outcome Titles: Provide descriptive outcome titles based on quiz title and goal.\n\n2) Outcome Descriptions: Each outcome should have at least 800 words formatted in HTML without first main heading(h1), explaining the outcome, including strengths and suggestions for improvement.\n\n3) Call to Action: Include a call to action for each outcome that encourages the user to take specific steps based on their outcome.%%OUTCOME_LIMIT%%\n   \n\n<span>Need entire outcome content in ONE JSON CODE response. It should be in JSON format with an easy copy code button:\n[{\n"title": "",\n"description": ""},\n{\n"title": "",\n"description": ""}]</span>',

		'pdf_aicontent' => 'I am looking to create a detailed report on a specific quiz outcome.\nHere are the quiz details:\n\nQuiz name: %%QUIZ_NAME%%\nGoal of this quiz: %%GOAL%%\nLanguage: %%LANGUAGE%%\nThere are a total of %%OUTCOME_COUNT%% outcomes in this quiz.\nThe outcomes are:\n%%ALL_OUTCOMES%%\n\nI need you to generate a detailed report [2000 words] specific to this outcome:\n%%SELECTED_OUTCOME%%\n\n<span>Instructions:\nPlease provide an HTML code block response including ONLY the following tags: "p", "ul", and "h2" and don\'t include any special tags like "html","body".\nAdd response in code block like:\n```HTML\nResponse goes here\n```</span>',

		'quiz_type_prompt' => 'I am looking to create a %%TYPE%% quiz in this language: %%LANGUAGE%%. \n\nThe quiz topic is: \n%%QUIZ_TOPIC%% \n\nTarget Audience:\n%%QUIZ_TARGET%% \n\nCan you give %%QCOUNT%% relevant quiz ideas, along with a detailed description that outlines what the quiz does? \n\nStart with a description along the lines of:\nThis quiz will help "%%QUIZ_TARGET%%".... \n\nDon\'t give back response in just text. Use JSON code format. s: \n[ { "title": "title 1" "description": "description 1"}, { "title": "title 2" "description": "description 2" }]'

	);



	return $prompt_data;

}





?>