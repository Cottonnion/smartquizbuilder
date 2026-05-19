 function sqb_auto_top_style_of_each_ans_section(){
	jQuery('.parent-node').each(function(){
	var ans_top_list =  [] 
	jQuery(this).find('.funnel_answer_title').each(function(){
	  var x = jQuery(this).position();
	  var ans_top = x.top;
	  ans_top_list.push(ans_top);
	});
	
	jQuery(this).find('.outputs .output').each(function(index){
		
		jQuery(this).css({'position': 'absolute','bottom': 0,'right': '-10px',top: (ans_top_list[index]+10)+'px'})
	});
	
	
	var node_id = jQuery(this).find('.drawflow-node').attr('id');
	editor.updateConnectionNodes(node_id);
	
	});
}


 function sqbCreateBranch(drawflowArr, response){

	//drawflowArr = JSON.parse(drawflowArr);
	//drawflowArr = jQuery.trim(drawflowArr); 
	
	drawflowArr = JSON.parse(drawflowArr);
	
    //editor.drawflow = {"drawflow":{"Home":{"data":{"1":{"id":1,"name":"welcome","data":{},"class":"welcome","html":"\n    <div>\n      <div class=\"title-box\">👏 Welcome!!</div>\n      <div class=\"box\">\n        <p>Simple flow library <b>demo</b>\n        <a href=\"https://github.com/jerosoler/Drawflow\" target=\"_blank\">Drawflow</a> by <b>Jero Soler</b></p><br>\n\n        <p>Multiple input / outputs<br>\n           Data sync nodes<br>\n           Import / export<br>\n           Modules support<br>\n           Simple use<br>\n           Type: Fixed or Edit<br>\n           Events: view console<br>\n           Pure Javascript<br>\n        </p>\n        <br>\n        <p><b><u>Shortkeys:</u></b></p>\n        <p>🎹 <b>Delete</b> for remove selected<br>\n        💠 Mouse Left Click == Move<br>\n        ❌ Mouse Right == Delete Option<br>\n        🔍 Ctrl + Wheel == Zoom<br>\n        📱 Mobile support<br>\n        ...</p>\n      </div>\n    </div>\n    ","typenode": false, "inputs":{},"outputs":{},"pos_x":50,"pos_y":150},"2":{"id":2,"name":"slack","data":{},"class":"slack","html":"\n          <div>\n            <div class=\"title-box\"><i class=\"fab fa-slack\"></i> Slack chat message</div>\n          </div>\n          ","typenode": false, "inputs":{"input_1":{"connections":[{"node":"7","input":"output_1"}]}},"outputs":{},"pos_x":1028,"pos_y":87},"3":{"id":3,"name":"telegram","data":{"channel":"channel_2"},"class":"telegram","html":"\n          <div>\n            <div class=\"title-box\"><i class=\"fab fa-telegram-plane\"></i> Telegram bot</div>\n            <div class=\"box\">\n              <p>Send to telegram</p>\n              <p>select channel</p>\n              <select df-channel>\n                <option value=\"channel_1\">Channel 1</option>\n                <option value=\"channel_2\">Channel 2</option>\n                <option value=\"channel_3\">Channel 3</option>\n                <option value=\"channel_4\">Channel 4</option>\n              </select>\n            </div>\n          </div>\n          ","typenode": false, "inputs":{"input_1":{"connections":[{"node":"7","input":"output_1"}]}},"outputs":{},"pos_x":1032,"pos_y":184},"4":{"id":4,"name":"email","data":{},"class":"email","html":"\n            <div>\n              <div class=\"title-box\"><i class=\"fas fa-at\"></i> Send Email </div>\n            </div>\n            ","typenode": false, "inputs":{"input_1":{"connections":[{"node":"5","input":"output_1"}]}},"outputs":{},"pos_x":1033,"pos_y":439},"5":{"id":5,"name":"template","data":{"template":"Write your template"},"class":"template","html":"\n            <div>\n              <div class=\"title-box\"><i class=\"fas fa-code\"></i> Template</div>\n              <div class=\"box\">\n                Ger Vars\n                <textarea df-template></textarea>\n                Output template with vars\n              </div>\n            </div>\n            ","typenode": false, "inputs":{"input_1":{"connections":[{"node":"6","input":"output_1"}]}},"outputs":{"output_1":{"connections":[{"node":"4","output":"input_1"},{"node":"11","output":"input_1"}]}},"pos_x":607,"pos_y":304},"6":{"id":6,"name":"github","data":{"name":"https://github.com/jerosoler/Drawflow"},"class":"github","html":"\n          <div>\n            <div class=\"title-box\"><i class=\"fab fa-github \"></i> Github Stars</div>\n            <div class=\"box\">\n              <p>Enter repository url</p>\n            <input type=\"text\" df-name>\n            </div>\n          </div>\n          ","typenode": false, "inputs":{},"outputs":{"output_1":{"connections":[{"node":"5","output":"input_1"}]}},"pos_x":341,"pos_y":191},"7":{"id":7,"name":"facebook","data":{},"class":"facebook","html":"\n        <div>\n          <div class=\"title-box\"><i class=\"fab fa-facebook\"></i> Facebook Message</div>\n        </div>\n        ","typenode": false, "inputs":{},"outputs":{"output_1":{"connections":[{"node":"2","output":"input_1"},{"node":"3","output":"input_1"},{"node":"11","output":"input_1"}]}, "output_2":{"connections":[{"node":"2","output":"input_1"},{"node":"3","output":"input_1"},{"node":"11","output":"input_1"}]}},"pos_x":347,"pos_y":87},"11":{"id":11,"name":"log","data":{},"class":"log","html":"\n            <div>\n              <div class=\"title-box\"><i class=\"fas fa-file-signature\"></i> Save log file </div>\n            </div>\n            ","typenode": false, "inputs":{"input_1":{"connections":[{"node":"5","input":"output_1"},{"node":"7","input":"output_1"}]}},"outputs":{},"pos_x":1031,"pos_y":363}}},"Other":{"data":{"8":{"id":8,"name":"personalized","data":{},"class":"personalized","html":"\n            <div>\n              Personalized\n            </div>\n            ","typenode": false, "inputs":{"input_1":{"connections":[{"node":"12","input":"output_1"},{"node":"12","input":"output_2"},{"node":"12","input":"output_3"},{"node":"12","input":"output_4"}]}},"outputs":{"output_1":{"connections":[{"node":"9","output":"input_1"}]}},"pos_x":764,"pos_y":227},"9":{"id":9,"name":"dbclick","data":{"name":"Hello World!!"},"class":"dbclick","html":"\n            <div>\n            <div class=\"title-box\"><i class=\"fas fa-mouse\"></i> Db Click</div>\n              <div class=\"box dbclickbox\" ondblclick=\"showpopup(event)\">\n                Db Click here\n                <div class=\"modal\" style=\"display:none\">\n                  <div class=\"modal-content\">\n                    <span class=\"close\" onclick=\"closemodal(event)\">&times;</span>\n                    Change your variable {name} !\n                    <input type=\"text\" df-name>\n                  </div>\n\n                </div>\n              </div>\n            </div>\n            ","typenode": false, "inputs":{"input_1":{"connections":[{"node":"8","input":"output_1"}]}},"outputs":{"output_1":{"connections":[{"node":"12","output":"input_2"}]}},"pos_x":209,"pos_y":38},"12":{"id":12,"name":"multiple","data":{},"class":"multiple","html":"\n            <div>\n              <div class=\"box\">\n                Multiple!\n              </div>\n            </div>\n            ","typenode": false, "inputs":{"input_1":{"connections":[]},"input_2":{"connections":[{"node":"9","input":"output_1"}]},"input_3":{"connections":[]}},"outputs":{"output_1":{"connections":[{"node":"8","output":"input_1"}]},"output_2":{"connections":[{"node":"8","output":"input_1"}]},"output_3":{"connections":[{"node":"8","output":"input_1"}]},"output_4":{"connections":[{"node":"8","output":"input_1"}]}},"pos_x":179,"pos_y":272}}}}}
	 editor.drawflow = drawflowArr

   
  
    editor.start();
     if(typeof response != 'undefined'){
		if(typeof response.funeel_answer_delete_ids != 'undefined'){
		  jQuery.each(response.funeel_answer_delete_ids , function(key, value){
			jQuery.each(value, function(num, output){
				
				var sqb_str = output;
				var sqb_str_array = sqb_str.split("_");
				
				
				var new_number = sqb_str_array[1]-num;
				output = sqb_str_array[0]+'_'+new_number;
				
			  editor.removeNodeOutput(key, output); 
			});
		  });
		}
	}

    editor.zoom_reset();
    
  sqb_auto_top_style_of_each_ans_section(); 
  
  //editor.removeConnectionNodeId(1);
	

	


  /*
    var welcome = `
    <div>
      <div class="title-box">👏 Welcome!!</div>
      <div class="box">
        <p>Simple flow library <b>demo</b>
        <a href="https://github.com/jerosoler/Drawflow" target="_blank">Drawflow</a> by <b>Jero Soler</b></p><br>
        <p>Multiple input / outputs<br>
           Data sync nodes<br>
           Import / export<br>
           Modules support<br>
           Simple use<br>
           Type: Fixed or Edit<br>
           Events: view console<br>
           Pure Javascript<br>
        </p>
        <br>
        <p><b><u>Shortkeys:</u></b></p>
        <p>🎹 <b>Delete</b> for remove selected<br>
        💠 Mouse Left Click == Move<br>
        ❌ Mouse Right == Delete Option<br>
        🔍 Ctrl + Wheel == Zoom<br>
        📱 Mobile support<br>
        ...</p>
      </div>
    </div>
    `;
*/


    //editor.addNode(name, inputs, outputs, posx, posy, class, data, html);
    /*editor.addNode('welcome', 0, 0, 50, 50, 'welcome', {}, welcome );
    editor.addModule('Other');
    */

    // Events!
    editor.on('nodeCreated', function(id) {
     // console.log("Node created " + id);
    })

    editor.on('nodeRemoved', function(id) {
      //console.log("Node removed " + id);
    })

    editor.on('nodeSelected', function(id) {
      //console.log("Node selected " + id);
    })

    editor.on('moduleCreated', function(name) {
     // console.log("Module Created " + name);
    })

    editor.on('moduleChanged', function(name) {
     // console.log("Module Changed " + name);
    })

    editor.on('connectionCreated', function(connection) {
      //console.log('Connection created');
      //console.log(connection);
      
      if(jQuery('#node-'+connection.output_id).find('.multiple_correct_ans').length > 0){
        var classLength = jQuery('.node_out_node-'+connection.output_id).length;

        if(classLength > 1){
          jQuery('.node_out_node-'+connection.output_id).each(function(){
            
            if(jQuery(this).hasClass('node_in_node-'+connection.input_id)){

            }else{
              swal("" , 'This question allows users to pick "multiple answer choices". In this type of question, every answer choice needs to be connected to the same next question.', "");
          
              editor.removeSingleConnection(connection.output_id, connection.input_id, connection.output_class, connection.input_class);
           
                 
              
            }
          });
        }
      }
     

    })

    editor.on('connectionRemoved', function(connection) {
      //console.log('Connection removed');
      //console.log(connection);
    })

    editor.on('mouseMove', function(position) {
  //    console.log('Position mouse x:' + position.x + ' y:'+ position.y);
    })

    editor.on('zoom', function(zoom) {
      //console.log('Zoom level ' + zoom);
    })

    editor.on('translate', function(position) {
      //console.log('Translate x:' + position.x + ' y:'+ position.y);
    })

    /* DRAG EVENT */

    /* Mouse and Touch Actions */

    var elements = document.getElementsByClassName('drag-drawflow');
    for (var i = 0; i < elements.length; i++) {
      elements[i].addEventListener('touchend', drop, false);
      elements[i].addEventListener('touchmove', positionMobile, false);
      elements[i].addEventListener('touchstart', drag, false );
    }


    var mobile_item_selec = '';
    var mobile_last_move = null;
   function positionMobile(ev) {
     mobile_last_move = event;
   }

   function allowDrop(ev) {
	  ev.preventDefault();
    }

    function drag(ev) {
		//console.log('ev');
		//console.log(ev);
      if (ev.type === "touchstart") {

        mobile_item_selec = ev.target.closest(".drag-drawflow").getAttribute('data-node');
      } else {
		
		 // console.log('ev.dataTransfer');
		 // console.log(ev.dataTransfer);
		ev.dataTransfer.setData("node", ev.target.getAttribute('data-node'));
      }
    }

    function drop(ev) {
		
      if (ev.type === "touchend") {
        var parentdrawflow = document.elementFromPoint( mobile_last_move.touches[0].clientX, mobile_last_move.touches[0].clientY).closest("#drawflow");
        if(parentdrawflow != null) {
          addNodeToDrawFlow(mobile_item_selec, mobile_last_move.touches[0].clientX, mobile_last_move.touches[0].clientY);
        }
        mobile_item_selec = '';
      } else {
        ev.preventDefault();
        var data = ev.dataTransfer.getData("node");
        addNodeToDrawFlow(data, ev.clientX, ev.clientY);
      }

    }

    function addNodeToDrawFlow(name, pos_x, pos_y) {
      
      if(editor.editor_mode === 'fixed') {
        return false;
      }
    
      pos_x = pos_x * ( editor.precanvas.clientWidth / (editor.precanvas.clientWidth * editor.zoom)) - (editor.precanvas.getBoundingClientRect().x * ( editor.precanvas.clientWidth / (editor.precanvas.clientWidth * editor.zoom)));
      pos_y = pos_y * ( editor.precanvas.clientHeight / (editor.precanvas.clientHeight * editor.zoom)) - (editor.precanvas.getBoundingClientRect().y * ( editor.precanvas.clientHeight / (editor.precanvas.clientHeight * editor.zoom)));


      switch (name) {
        /*case 'start':
        var response = jQuery('.startTemplate1').html();
        var funnelId = jQuery('.funnelId').val();
        var start = '<div class="quiz-funnel-input main-question-block"><span class="sqb_funnel_remove_section"><i class="fa fa-times" aria-hidden="true"></i></span>'+response+'<div  class="Template-popup-link dropdown"><button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span> ...</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButton"><a class="dropdown-item selecteTemplateModalBtn" data-id="firstTemplateSelect1" href="#">Select START Template</a><a data-id="firstTemplateSelect1" class="switchScreenBtn dropdown-item" data-level="1" data-funnelid="'+funnelId+'">Switch Screen</a></div></div></div></div></div></div>';
          editor.addNode('start', 0,  1, pos_x, pos_y, 'start', {}, start );
          break;*/
        case 'qatemplate':
			var response = sqbAppendQuestionScreen(1, 1 ,'' , '', 'main-question-block');
			var funnelId = jQuery('.funnelId').val();
			var qatemplate = response;
          editor.addNode('qatemplate', 1, 1, pos_x, pos_y, 'qatemplate', {}, qatemplate );
          break;
        case 'opt-in':
          var optin = '';
          editor.addNode('optin', 0, 1, pos_x, pos_y, 'optin', {}, optin );
          break;
        case 'result':
          var result = '';
          editor.addNode('result', 1, 0, pos_x, pos_y, 'result', {}, result );
          break;
        default:
      }
    }

  var transform = '';
  function showpopup(e) {
    e.target.closest(".drawflow-node").style.zIndex = "9999";
    e.target.children[0].style.display = "block";
    //document.getElementById("modalfix").style.display = "block";

    //e.target.children[0].style.transform = 'translate('+translate.x+'px, '+translate.y+'px)';
    transform = editor.precanvas.style.transform;
    editor.precanvas.style.transform = '';
    editor.precanvas.style.left = editor.canvas_x +'px';
    editor.precanvas.style.top = editor.canvas_y +'px';
   // console.log(transform);

    //e.target.children[0].style.top  =  -editor.canvas_y - editor.container.offsetTop +'px';
    //e.target.children[0].style.left  =  -editor.canvas_x  - editor.container.offsetLeft +'px';
    editor.editor_mode = "fixed";

  }

   function closemodal(e) {
     e.target.closest(".drawflow-node").style.zIndex = "2";
     e.target.parentElement.parentElement.style.display  ="none";
     //document.getElementById("modalfix").style.display = "none";
     editor.precanvas.style.transform = transform;
       editor.precanvas.style.left = '0px';
       editor.precanvas.style.top = '0px';
      editor.editor_mode = "edit";
   }

    function changeModule(event) {
      var all = document.querySelectorAll(".menu ul li");
        for (var i = 0; i < all.length; i++) {
          all[i].classList.remove('selected');
        }
      event.target.classList.add('selected');
    }

    function changeMode(option) {

    //console.log(lock.id);
      if(option == 'lock') {
        lock.style.display = 'none';
        unlock.style.display = 'block';
      } else {
        lock.style.display = 'block';
        unlock.style.display = 'none';
      }

    }
   
   } 
