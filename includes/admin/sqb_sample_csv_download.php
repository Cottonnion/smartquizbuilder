<?php

if(isset($_GET['csv_type']) && $_GET['csv_type'] == 'sample_csv'){
header("Content-type: application/csv");
header("Content-Disposition: attachment; filename=SQB_SampleQuestionAnswers.csv");
$output = fopen('php://output', 'w');
fputcsv($output, array('QuestionType','QuestionText','Explanation','Answer1','Correct1','Points1','Answer2','Correct2','Points2','Answer3','Correct3','Points3','Answer4','Correct4','Points4','Answer5','Correct5','Points5','Answer6','Correct6','Points6','Answer7','Correct7','Points7','Answer8','Correct8','Points8','Answer9','Correct9','Points9','Answer10','Correct10','Points10'));
fputcsv($output, array("multiple_choice","1 Question text.","1 Question description.","Answer title1","Y",1,"Answer title2","Y",1,"Answer title3","Y",1,"Answer title4","Y",1,"Answer title5","Y",1,"Answer title6","N",1,"Answer title7","N",1,"Answer title8","N",1,"Answer title9","N",1,"Answer title10","N",1));
fputcsv($output, array("single_choice","2 Question text.","2 Question description.","Answer title1","N",1,"Answer title2","N",1,"Answer title3","N",1,"Answer title4","N",1,"Answer title5","Y",1,"Answer title6","N",1,"Answer title7","N",1,"Answer title8","N",1,"Answer title9","N",1,"Answer title10","N",1));
fputcsv($output, array("rating","3 Question text.","3 Question description.","1","N",1,"2","N",1,"3","N",1,"4","N",1,"5","Y",1));
fputcsv($output, array("ranking_choice","4 Question text.","4 Question description.","Answer title1","N",1,"Answer title2","N",1,"Answer title3","N",1,"Answer title4","N",1,"Answer title5","Y",1,"Answer title6","N",1,"Answer title7","N",1,"Answer title8","N",1,"Answer title9","N",1,"Answer title10","N",1));
fputcsv($output, array("yes_no","5 Question text.","5 Question description.","Yes","N",1,"No","N",1));
fputcsv($output, array("text","6 Question text.","6 Question description."));
fputcsv($output, array("slider","7 Question text.","7 Question description."));
fputcsv($output, array("file_upload","8 Question text.","8 Question description."));

} else {

header("Content-type: application/csv");
header("Content-Disposition: attachment; filename=SQB CSV Import Instructions.csv");
$output = fopen('php://output', 'w');	
fputcsv($output, array('QuestionType','Question Type is required.'));
fputcsv($output, array('QuestionText','Question Text is required.'));
fputcsv($output, array('Answer1','Answer1 Text is required.'));
fputcsv($output, array("","",""));
fputcsv($output, array("","Use the following abbreviations for supported question types:",""));
fputcsv($output, array("","single_choice","Single choice question. Users can only pick 1 answer."));
fputcsv($output, array("","multiple_choice","Multiple choice question. Users can pick more than 1 answer."));
fputcsv($output, array("","text","Open-ended question where users can type in answer."));
fputcsv($output, array("","rating","Single choice question. Users can only pick 1 answer."));
fputcsv($output, array("","ranking_choice","Ranking choice question. Users can rearrange answers."));
fputcsv($output, array("","yes_no","Single choice question. Users can only pick 1 answer."));
fputcsv($output, array("","slider","Slider type question where users can select any value in answer."));
fputcsv($output, array("","file_upload","File Upload type question where users can upload a file in answer."));
fputcsv($output, array("","",""));
fputcsv($output, array("Notes:","Enter up to 10 answer choices for single_choice,multiple_choice,ranking_choice,rating type question."));
fputcsv($output, array("","To import questions/answers: First create a quiz in SQB. Next, add questions via the SQB >> Settings page >> Import functionality."));
fputcsv($output, array("","Formatting in your spreadsheet will be removed during import (italics, font size, hyperlinks, etc.)."));
fputcsv($output, array("","Please do not remove the worksheets (tabs) in this file. This will cause the import to fail.	"));
fputcsv($output, array("","The more questions you import, the longer it'll take to process."));
}

fclose($output);

