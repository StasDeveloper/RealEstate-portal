<!-- new widget -->
<div class="chatWidget js-chat-widget jarviswidget jarviswidget-color-blue"
     id="wid-id-1"
     data-widget-editbutton="false"
     data-widget-colorbutton="false"
     data-widget-deletebutton="false"
     data-delay="<?php echo isset($this->options['delay']) ? $this->options['delay'] : $this->_options['delay']; ?>"
     data-maxmsglength="<?php echo isset($this->options['maxMsgLegth']) ? $this->options['maxMsgLegth'] : $this->_options['maxMsgLegth']; ?>"
     data-property_id="<?php echo $options['property_id'];?>"
     data-owner_mid="<?php echo $options['owner_mid'];?>"
     data-property_zipcode="<?php echo $options['property_zipcode'];?>"
     data-property_status="<?php echo $options['property_status']; ?>"
     data-property_street="<?php echo $options['property_street']; ?>"
     data-property_type="<?php echo $options['property_type']; ?>"
    >

    <!-- widget options:
    usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

    data-widget-colorbutton="false"
    data-widget-editbutton="false"
    data-widget-togglebutton="false"
    data-widget-deletebutton="false"
    data-widget-fullscreenbutton="false"
    data-widget-custombutton="false"
    data-widget-collapsed="true"
    data-widget-sortable="false"

    -->
    <header>
        <span class="widget-icon"> <i class="fa fa-comments txt-color-white"></i> </span>
        <h2> Contact the Agent </h2>
        <div class="widget-toolbar">
            <!-- add: non-hidden - to disable auto hide -->

            <div class="btn-group">
                <button class="btn dropdown-toggle btn-xs btn-success" data-toggle="dropdown">
                    Connect <i class="fa fa-caret-down"></i>
                </button>
                <ul class="dropdown-menu pull-right js-status-update">
                    <li id="chat_button_li">
                        <a href="javascript:void(0);"><i class="fa fa-circle txt-color-green"></i> Chat</a>
                    </li>
                    <li id="message_button_li">
                        <a href="javascript:void(0);"><i class="fa fa-circle txt-color-blue"></i> Message</a>
                    </li>
                    <li class="divider"></li>
                    <li id="block_button_li">
                        <a href="javascript:void(0);"><i class="fa fa-power-off"></i> Block</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <!-- widget div-->
    <div>
        <!-- widget edit box -->
        <div class="jarviswidget-editbox">
            <div>
                <label>Title:</label>
                <input type="text" />
            </div>
        </div>
        <!-- end widget edit box -->

        <div class="widget-body widget-hide-overflow no-padding">
            <!-- content goes here -->

            <!-- CHAT CONTAINER -->
            <div id="chat-container">
                <span class="chat-list-open-close"><i class="fa fa-user"></i><b id="agent_count_flag">4</b></span>

                <div class="chat-list-body custom-scroll">
                    <ul id="chat-users">
                        <li>
                            <a href="javascript:void(0);">
                                <img src="<?php echo CPathCDN::baseurl( 'images' ) ; ?>/images/avatars/male.png"
                                     alt="">Mark Zeukartech<span class="label label-success pull-right">4.8 Stars</span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                <img src="<?php echo CPathCDN::baseurl( 'images' ) ; ?>/images/avatars/male.png"
                                     alt="">Jan Jones<span class="label label-primary pull-right">Agent</span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                <img src="<?php echo CPathCDN::baseurl( 'images' ) ; ?>/images/avatars/male.png"
                                     alt="">Galvitch Drewbery<span class="label label-info pull-right">Saved</span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                <img src="<?php echo CPathCDN::baseurl( 'images' ) ; ?>/images/avatars/male.png"
                                     alt="">Sunny <span class="state"><i class="last-online pull-right">Online</i></span> </a>
                        </li>
                    </ul>
                </div>
                <div class="chat-list-footer">

                    <div class="control-group">

                        <form class="smart-form">

                            <section>
                                <label class="input">
                                    <input type="text" id="filter-chat-list" placeholder="Filter">
                                </label>
                            </section>

                        </form>

                    </div>

                </div>

            </div>

            <!-- CHAT BODY -->
            <div id="chat-body" class="chat-body custom-scroll">
                <ul class='current-agent-chat-title' id="current-agent-chat" data-current_agent_mid=""></ul>
                <ul id="js-chat-messages"></ul>

            </div>

            <!-- CHAT FOOTER -->
            <div class="chat-footer">

                <!-- CHAT TEXTAREA -->
                <div class="textarea-div">

                    <div class="typearea">
                        <textarea placeholder="I would like more information on homes for sale in the area that are similar to <?php echo $options['property_street']?>"
                                  id="textarea-expand" class="custom-scroll" <?php echo Yii::app()->user->isGuest? 'disabled="disabled"':'';?>></textarea>
                    </div>

                </div>

                <!-- CHAT REPLY/SEND -->
                <span class="textarea-controls">
                    <button class="btn btn-sm btn-primary pull-right <?php echo Yii::app()->user->isGuest? 'disabled':'';?>">Send</button> 
                    <span class="pull-right smart-form" style="margin-top: 3px; margin-right: 10px;"> 
                        <?php /*<label class="checkbox pull-right">
                            <input type="checkbox" name="subscription" id="subscription" <?php echo Yii::app()->user->isGuest? 'disabled':'';?> >
                            <i></i> <strong> SAVE </strong> this Agent
                        </label> */ ?>
                    </span> 
<!--                    <a href="javascript:void(0);" class="pull-left"><i class="fa fa-camera fa-fw fa-lg"></i></a> -->
                </span>

            </div>

            <!-- end content -->
        </div>

    </div>
    <!-- end widget div -->
</div>
<!-- end widget -->

<div id="unAuthModal" role="dialog" tabindex="-1" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close closeModal" type="button">×</button><h1><?php echo UserModule::t("Hello!"); ?></h1>
            </div>
            <div class="modal-body">
                <p>You've got to sign up or log in to use this feature. Joining is free!</p>
                <div class="modal-footer">
                    <?php echo CHtml::link(UserModule::t('Sign up'), array(Yii::app()->createUrl('user/registration')), array('class'=>"btn btn-primary", ''=>"", 'id'=>"")); ?>
                    &nbsp;
                    <?php echo CHtml::link(UserModule::t('Log in'), array(Yii::app()->createUrl('user/login')), array('class'=>"btn btn-primary", 'name'=>"", 'id'=>"")); ?>
                    &nbsp;
                    <button data-dismiss="modal" class="btn btn-default closeModal" name="yt2" type="button">Close</button>
                </div>

            </div>
        </div>
    </div>
</div>

<?php Yii::app()->clientScript->registerScript(
    "disabledAreaBehavior",
    "
            $('.chat-footer .textarea-div').on('click', function(){
                if($(this).find('textarea').prop('disabled')){
                    $('#unAuthModal').modal('show');
                }
            });
                
            $('.chat-footer .textarea-controls').on('click', function(){
                if($(this).find('button').prop('disabled')){
                    $('#unAuthModal').modal('show');
                }
                if($(this).find('#subscription').prop('disabled')){
                   $('#unAuthModal').modal('show');
                }
                
            });  
            
            
        
            $('.chat-list-body #chat-users').on('click','li a', function(e) {
                e.preventDefault; 
                
                var _this = $(this);
                var kind = _this.data('kind');
                var current_mid = _this.data('mid');
                var agent_index = _this.data('index');
                var savedAgent = _this.attr('data-saved');
                if(savedAgent == 'yes'){
                    $('#subscription').prop('checked', true);
                }
                if(savedAgent == 'no'){
                    $('#subscription').prop('checked', false);
                }
                $('#current-agent-chat').attr('data-current_agent_mid',current_mid); 
                $('.chat-list-body #chat-users li a').each(function(){
                    $(this).removeClass('active');
                });
                _this.addClass('active');
                
                _this.parent().insertBefore($('#chat-users li:first'))
                switch(Chat.user_type){
                    case 'user':
                        Chat.stopInterval();
//                        console.log('stopInterval as user str217');
                        Chat.insertCurrentChatTitle(Chat.property_agents_info[kind][agent_index]);
                        Chat.loadMessages(current_mid, Chat.current_user_id);
//                        Chat.startInterval(current_mid, Chat.current_user_id);
//                        console.log('startInterval as user str220');
                        break;
                    
                    case 'owner':
                        Chat.stopInterval();
//                        console.log('stopInterval as owner str226');
                        Chat.insertCurrentChatTitle(Chat.property_agents_info[kind][agent_index]);
                        Chat.loadMessages(Chat.current_user_id, parseInt(current_mid));
                        Chat.startInterval(Chat.current_user_id, parseInt(current_mid));
//                        console.log('startInterval as owner str229');
                        break;
                }
               
                return false;
            });
            
        $('#chat_button_li').on('click', function(){
            if(!$('#chat-users li a.active img').hasClass('online')){
//                console.log('offline');
                if($('#chat-users li').size()>0){
                    var li_arr = [];
                    $('#chat-users li').each(function(){
                        if($(this).find('img').hasClass('online')){
                            li_arr.push($(this).index());
                        } 
                    });
                    $('#chat-users li:eq('+li_arr[0]+') a').trigger('click');
                }
            } 
        });
        
        $('#block_button_li a').on('click', function(){
            Chat.stopInterval();
            Chat.stopIntervalNewCustomers()
        });
        
        
        $('.textarea-controls button').on('click', function(){
            //current_agent_mid = $('#chat-users li a.active').data('mid'); 
            current_agent_mid = $('#current-agent-chat').attr('data-current_agent_mid');    
            
            var text_message = $('#textarea-expand').val();
            
            var isOnline = $('#chat-users li a.active').attr('data-is_online');
            
            if(text_message != ''){
                if(Chat.user_type === 'owner'){
                    Chat.stopInterval();
//                    console.log('stopInterval as owner str248');
                    var kind = $('#chat-users li a.active').attr('data-kind'); 
                    if(kind == 'collocutor_list'){
                        Chat.sendMessage(text_message+kind, Chat.current_user_id, current_agent_mid, isOnline);
                    } else {
                        Chat.sendMessage(text_message+kind, current_agent_mid, Chat.current_user_id, isOnline);
                    }
                    
                    
                    Chat.clearTextareaExpand();
                    Chat.startInterval(Chat.current_user_id, current_agent_mid);
//                    console.log('startInterval as owner str252');
                   
                } else {
                    Chat.stopInterval();
//                    console.log('stopInterval as user str256');
                    
                    Chat.sendMessage(text_message, current_agent_mid, Chat.current_user_id, isOnline);
                    Chat.clearTextareaExpand();
                    Chat.startInterval(current_agent_mid, Chat.current_user_id);
//                    console.log('startInterval as user str260');
                }
                
            }
            
        });
        
        $('#subscription').on('click',function(){
            var agent_id = 0;
            if($(this).prop('checked') == true){
                agent_id = $('#chat-users').find('a.active').data('mid');
                Chat.saveAgent(agent_id);
            } else { 
                agent_id = $('#chat-users').find('a.active').data('mid');
                Chat.deleteSavedAgent(agent_id);
            }
        });
    
        
           Chat.start();
           
        ",
    CClientScript::POS_READY);

$user_id = !Yii::app()->user->isGuest ? Yii::app()->user->id : 0;
Yii::app()->clientScript->registerScript(
    "chatScript",
    "
    checkIncorrectAddress = function(zipArray, userZip){
        if(_.indexOf(zipArray, userZip) == -1){
            $('citystatezip').html('');
        }
    };
    var Chat = {
            _this : '',
            delay : '',
            maxMsgLength : '',
            property_id :  '',
            owner_mid : '',
            property_zipcode : '',
            current_agent_mid : '',
            property_status : '',
            property_street : '',
            property_agents_info : '',
            interval : '',
            intervalNewCustomers : '',
            current_user_id : '',                       
            current_agent : '',
            user_type : '',
            chat_users : '',
            room_counter : '',
            message_created : '',
            
            start: function (){
                Chat.current_user_id = ".$user_id.";
                Chat._this = $(document).find('.js-chat-widget');
                Chat.delay = $(Chat._this).data('delay') || 10000;
                Chat.maxMsgLength = $(Chat._this).data('maxmsglength') || 150;
                Chat.property_id =  $(Chat._this).data('property_id') || 0;
                Chat.owner_mid = $(Chat._this).data('owner_mid') || 0;
                Chat.property_zipcode = $(Chat._this).data('property_zipcode') || 0;
                Chat.current_agent_mid = $(Chat._this).data('current_agent_mid') || 0;
                Chat.property_status = $(Chat._this).data('property_status') || 0;
                Chat.property_street = $(Chat._this).data('property_street') || 0;
                Chat.property_type = $(Chat._this).data('property_type') || null;
                Chat.loadMessagesFistTime();
            },
            
            loadMessagesFistTime : function(){
                $.ajax({
                    url: '/property/chat',
                    data: {action: 'get',
                           owner_mid: Chat.owner_mid,
                           property_zipcode: Chat.property_zipcode
                       },
                    type: 'POST',
                    dataType: 'json',
                    cache: false,
                    success: function(data){Chat.loadSuccessFirstTime(data)},
                    error: Chat.loadError
                });
            },
            
            loadSuccessFirstTime : function(data){
               
                Chat.user_type = data.user_type;
                Chat.property_agents_info = data; 
                Chat.chat_users = data.chat_users;
                Chat.clearChatMessages();
                Chat.clearTextareaExpand();
                //=========================================================================================================
                if(Chat.user_type === 'owner'){                                                             // OWNER
                    Chat.clearChatUsers();
                    if(data.collocutor_list.length > 0){
                        Chat.loadCollocutorlist(data);
                        Chat.stopInterval();
                        var _this_collocutor = $('#chat-users li a.active').data('mid');
                        Chat.startInterval(Chat.current_user_id, _this_collocutor);
                        Chat.startIntervalNewCustomers();
                    } else {
                        Chat.loadListChatRooms(data); 
                        Chat.startIntervalNewCustomers();
                    }   
                }
                //=========================================================================================================
                if(Chat.user_type === 'user'){                                                              // USER
                
                    Chat.loadListChatRooms(data);
                    Chat.stopInterval();
                    var _this_chat_owner = $('#chat-users li a.active').data('mid');
                    if(Chat.current_user_id != ''){
                        //Chat.startInterval(_this_chat_owner, Chat.current_user_id);
                    }
                }
                //=========================================================================================================
                Chat.scrollBottom();
            },
            
            
            saveAgent : function(agent_id){
                $.ajax({
                    url: '/property/saveagent',
                    data:{ agent_id: agent_id },
                    type: 'POST',
                    dataType: 'json',
                    cache: false,
                    success: function(data){ 
                        $('#chat-users').find('a[data-mid=\"'+agent_id+'\"]').attr('data-saved','yes'); 
//                        console.log(data);
                    },
                    error: Chat.loadError()
                    
                     
                });
            },
            
            deleteSavedAgent : function(agent_id){
//                console.log('agent_id',agent_id);
                $.ajax({
                    url: '/property/detachagent',
                    data:{agent_id: agent_id},
                    type: 'post',
                    dataType: 'json',
                    cache: false,
                    
                    success: function(data){ 
//                        console.log('deleted',agent_id);
                        $('#chat-users').find('a[data-mid=\"'+agent_id+'\"][data-kind=\"saved_agents\"]').parent().detach();
                        if($('#chat-users li').size()>0){
                            var li_arr = [];
                            $('#chat-users li').each(function(){
                                if($(this).find('a').attr('data-is_online')=='yes'){
                                    li_arr.push($(this).index());
                                } 
                            });
                            if(li_arr.length > 0){
                                $('#chat-users li:eq('+li_arr[0]+') a').trigger('click'); 

                            } else {
                                $('#chat_button_li').css('display','none');
                            }
                        } else {
                            $('#current-agent-chat').empty();
                            $('#js-chat-messages').empty();
                        }
                    },
                    error: Chat.loadError()
                    
                });
            },
                    


            
            clearChatMessages : function(){
                $('#agent_count_flag').empty();
            },
            
            clearChatUsers : function(){
                $('#chat-users').empty();
            },
            
            loadCollocutorlist : function(data){
//                console.log('loadCollocutorlist: ',data);
                var flag_count = 0;
                if(data.collocutor_list.length > 0){
                   
                    for (var j=0; j < data.collocutor_list.length; j++){
                        var collocutor_list = data.collocutor_list[j];
                        var collocutor_listt_photo = collocutor_list.profile.upload_photo ? collocutor_list.profile.upload_photo : 'male.png';
                        var online = collocutor_list.user == 'yes' ? '<span class=\"label label-info pos-absol\">On Line</span>' : '<span class=\"label label-info pos-absol\">Off Line</span>'
                        $('#chat-users').append('<li>'+
                                '<a href=\"javascript:void(0);\"'+ 
                                    ' data-mid=\"'+collocutor_list.profile.mid+'\"'+ 
                                    ' data-kind=\"collocutor_list\"'+
                                    ' data-is_online=\"'+collocutor_list.user+'\"'+
                                    ' data-index=\"'+j+'\">'+
                                    '<img src=\"/images/avatars/'+collocutor_listt_photo+'\" alt=\"\">'+
                                    collocutor_list.profile.first_name+'&nbsp;'+collocutor_list.profile.last_name+
                                    online+'</a></li>');
                        if(j==0){
                            $('#chat-users li:eq(0) a').addClass('active');
                            Chat.current_agent = collocutor_list;
                            Chat.insertCurrentChatTitle(collocutor_list);
                            Chat.loadMessages(Chat.current_user_id, parseInt(collocutor_list.profile.mid)); 
                            
                            
                        }
                    }
                    flag_count += j;
                    $('#agent_count_flag').empty().html(flag_count);
                    
                    
                }
                if($('#chat-users li').size()>0){
                    var li_arr = [];
                    $('#chat-users li').each(function(){
                        if($(this).find('a').attr('data-is_online')=='yes'){
                            li_arr.push($(this).index());
                        } 
                    });
                    if(li_arr.length > 0){
                        $('#chat-users li:eq('+li_arr[0]+') a').trigger('click'); 
                        
                    } else {
                        $('#chat_button_li').css('display','none');
                    }
                }       
            },
            
            startIntervalNewCustomers : function(){
                Chat.intervalNewCustomers = setInterval(function(){
//                    console.log('intervalNewCustomers');
                    Chat.getNewCustomers();
                }, 1000*60);
            },
            
            stopIntervalNewCustomers : function(){
                clearInterval(Chat.intervalNewCustomers);
//                console.log('stopIntervalNewCustomers');
            },
            
            getNewCustomers : function(){                                               
                $.ajax({
                    url: '/property/chat',
                    data: {
                            user_type: Chat.user_type
                    },
                    type: 'POST',
                    dataType: 'json',
                    cache: false,
                    success: function(data){
                        
                        list_customers = [];
                        for ( var key in data.chat_users ){
                            for (var i in Chat.chat_users){
                                if (key == i){
                                    var old_row_online = data.chat_users[key].user == 'yes' ? 'On Line' : 'Off Line';
                                    $('#chat-users li a[data-mid='+key+']').find('span').empty().html(old_row_online);
                                    if(old_row_online == 'On Line'){
                                        if($('#chat-users li a[data-mid='+key+']').hasClass('active')){
                                        $('#current-agent-chat li:first img').addClass('online');
                                        }
                                    } else {
                                        if($('#chat-users li a[data-mid='+key+']').hasClass('active')){
                                        $('#current-agent-chat li:first img').removeClass('online');
                                        }
                                    }
                                    delete data.chat_users[key];
                                }
                            }
                        }
                        var flag_count = 0;
                        if(Object.keys(data.chat_users).length > 0){
                            for (var z in data.chat_users){
                                flag_count += 1;
                                Chat.chat_users[z] = data.chat_users[z];
                                Chat.property_agents_info.collocutor_list.push(data.chat_users[z]);
                                var collocutor_list = data.chat_users[z];
                                if(collocutor_list.profile.upload_photo === ''){
                                    var collocutor_list_photo = 'male.png';
                                } else {
                                    var collocutor_list_photo = collocutor_list.profile.upload_photo;
                                }

                                var online = collocutor_list.user == 'yes' ? 
                                    '<span class=\"label label-info pos-absol\">On Line</span>' :
                                    '<span class=\"label label-info pos-absol\">Off Line</span>';
                                var online_border = collocutor_list.user == 'yes' ? 'online' : '';
//                                console.log('#chat-users li:',$('#chat-users li').lenght);
                                $('#chat-users').append('<li>'+
                                        '<a href=\"javascript:void(0);\"'+ 
                                        ' data-mid=\"'+collocutor_list.profile.mid+'\"'+
                                        ' data-is_online=\"'+collocutor_list.user+'\"'+
                                        ' data-kind=\"collocutor_list\" data-index=\"'+j+'\">'+
                                            '<img class=\"'+online_border+'\" src=\"/images/avatars/'+collocutor_list_photo+'\" alt=\"\">'+
                                            collocutor_list.profile.first_name+'&nbsp;'+collocutor_list.profile.last_name+
                                            online+'</a></li>');
                                            
                                
                            }
                        }                              
                        var num = $('#agent_count_flag').text();
                        $('#agent_count_flag').empty().html(flag_count + parseInt(num));
                    },
                    error: Chat.loadError()
                });
            },
                        
            loadListChatRooms : function(data){
                Chat.clearChatUsers();
                var flag_count = 0, 
                    advertising_agents_flag = 0, 
                    ownew_prop_flag = 0, 
                    saved_agents_flag = 0, 
                    max_rating_flag = 0,
                    limitation_advertising_agents = 0;
                if(data.owner && data.owner.length > 0){
                    for(var n = 0; n < data.owner.length; n++){
                        var owner = data.owner[n];
                        var owner_online =  owner.user == 'yes' ? 'online' : '';
                        if(owner.profile.mid == Chat.current_user_id){
                            continue;
                        }
                        ownew_prop_flag ++;
                        var owner_photo = owner.profile.upload_photo ? owner.profile.upload_photo : 'male.png';
                        $('#chat-users').append('<li><a href=\"javascript:void(0);\"'+
                                                        ' data-mid=\"'+owner.profile.mid+'\"'+
                                                        ' data-kind=\"owner\"'+
                                                        ' data-is_online=\"'+owner.user+'\"'+
                                                        ' data-index=\"'+n+'\"'+
                                                        ' data-saved=\"no\">'+
                                                    '<img src=\"/images/avatars/'+owner_photo+'\" class=\"'+owner_online+'\" alt=\"\">'+owner.profile.first_name+'&nbsp;'+
                                                        owner.profile.last_name+'<span class=\"label label-primary pull-right\">Agent</span></a></li>');
                    }
                    flag_count += ownew_prop_flag;
                }
                if(data.advertising_agents_list){
                    limitation_advertising_agents = data.advertising_agents_list.length < 4 ? data.advertising_agents_list.length : 4;
                }
                if(limitation_advertising_agents > 0){
                    for(var i = 0; i < limitation_advertising_agents; i++){
                        
                        var agent = data.advertising_agents_list[i];
                        var advertising_online =  agent.user == 'yes' ? 'online' : '';
                        if(agent.profile.mid == Chat.current_user_id){
                            continue;
                        }
                        advertising_agents_flag ++;
                        var agent_photo = agent.profile.upload_photo ? agent.profile.upload_photo : 'male.png';
                        $('#chat-users').append('<li><a href=\"javascript:void(0);\"'+
                                                        ' data-mid=\"'+agent.profile.mid+'\"'+
                                                        ' data-kind=\"advertising_agents_list\"'+
                                                        ' data-is_online=\"'+agent.user+'\"'+
                                                        ' data-index=\"'+i+'\"'+
                                                        ' data-saved=\"no\">'+
                                                        '<img src=\"/images/avatars/'+agent_photo+'\" class=\"'+advertising_online+'\" alt=\"\">'+agent.profile.first_name+'&nbsp;'+
                                                            agent.profile.last_name+'<span class=\"label label-success pull-right\">Advertising</span></a></li>');

                    }
                    flag_count += advertising_agents_flag;
                }
                if(data.saved_agents && data.saved_agents.length > 0){
                    for (var j=0; j < data.saved_agents.length; j++){
                        var save_agent = data.saved_agents[j];
                        var save_online =  save_agent.user == 'yes' ? 'online' : '';
                        if(save_agent.profile.mid == Chat.current_user_id){
                            continue;
                        }
                        saved_agents_flag ++;
                        var saved_agent_photo = save_agent.profile.upload_photo ? save_agent.profile.upload_photo : 'male.png';
                        $('#chat-users').append('<li>'+
                                '<a href=\"javascript:void(0);\"'+
                                ' data-mid=\"'+save_agent.profile.mid+'\"'+
                                ' data-kind=\"saved_agents\"'+
                                ' data-is_online=\"'+save_agent.user+'\"'+
                                ' data-index=\"'+j+'\"'+
                                ' data-saved=\"yes\">'+
                                    '<img src=\"/images/avatars/'+saved_agent_photo+'\" class=\"'+save_online+'\" alt=\"\">'+
                                    save_agent.profile.first_name+'&nbsp;'+save_agent.profile.last_name+
                                    '<span class=\"label label-info pull-right\">Saved</span></a></li>');
                    }
                    flag_count += saved_agents_flag;
                }
                if(data.max_rating && data.max_rating.length > 0){
                    for (var k=0; k < data.max_rating.length; k++){
                        var max_rating_agent = data.max_rating[k];
                        var max_rating_online =  max_rating_agent.user == 'yes' ? 'online' : '';
                        if(max_rating_agent.profile.mid == Chat.current_user_id){
                            continue;
                        }
                        max_rating_flag ++;
                        var max_rating_photo = max_rating_agent.profile.upload_photo ? max_rating_agent.profile.upload_photo : 'male.png';
                        $('#chat-users').append('<li>'+
                                '<a href=\"javascript:void(0);\"'+
                                ' data-mid=\"'+max_rating_agent.profile.mid+'\"'+
                                ' data-kind=\"max_rating\"'+ 
                                ' data-is_online=\"'+max_rating_agent.user+'\"'+
                                ' data-index=\"'+k+'\"'+
                                ' data-saved=\"no\">'+
                                    '<img class=\"'+max_rating_online+'\" src=\"/images/avatars/'+max_rating_photo+'\"'+ 
                                         'alt=\"\">'+max_rating_agent.profile.first_name+' '+max_rating_agent.profile.last_name+
                                         '<span class=\"label label-success pull-right\">'+max_rating_agent.profile.rating_average+' Stars</span></a>'+
                            '</li>');
                    }
                    flag_count += max_rating_flag;
                }
                $('#agent_count_flag').empty().html(flag_count);
                
                if($('#chat-users li').size()>0){
                    var li_arr = [];
                    $('#chat-users li').each(function(){
                        if($(this).find('img').hasClass('online')){
                            li_arr.push($(this).index());
                        } 
                    });
                    if(li_arr.length > 0){
                        $('#chat-users li:eq('+li_arr[0]+') a').trigger('click');
                    } else {
                        $('#chat_button_li').css('display','none');
                        var current_agent = $('#chat-users li:eq(0) a');
                        if(current_agent.length > 0){
                            var kind_agent = current_agent.data('kind');
                            var agent_mid = current_agent.data('mid');
                            var agent_index = current_agent.data('index');
                            Chat.current_agent = data[kind_agent][agent_index];
                            Chat.insertCurrentChatTitle(Chat.current_agent);
                            Chat.loadMessages(agent_mid, Chat.current_user_id );
                            $('#chat-users li:eq(0) a').addClass('active');
                        } 
                    }
                } 
            },
            strrpos: function ( haystack, needle, offset){  
                var i = haystack.lastIndexOf( needle, offset ); 
                return i >= 0 ? i : false;
            },
            in_array: function (needle, haystack, strict) {	
                var found = false, key, strict = !!strict;
                for (key in haystack) {
                        if ((strict && haystack[key] === needle) || (!strict && haystack[key] == needle)) {
                                found = true;
                                break;
                        }
                }   
                return found;
            },

            zipsForLocation : [],

            checkZipCode : function(city, stateCode, agentZip){
                if(this.zipsForLocation.length == 0){
                    if(stateCode != '' && agentZip != '' && city != '' && city != null && city != 0){
                        var api_key = '".Yii::app()->params['zipCodeApiKey']."';
                        $.ajax({
                            async : true,
                            url: 'https://www.zipcodeapi.com/rest/'+api_key+'/city-zips.json/'+city+'/'+stateCode,
                            type: 'GET',
                            success: function(data){
                                this.zipsForLocation = data.zip_codes;
                                checkIncorrectAddress(this.zipsForLocation, agentZip)
                            },
                            error: function(xhr,tStatus,e){
                                console.log('error');
                            }
                        })
                    }
                }
                else{
                    checkIncorrectAddress(this.zipsForLocation, agentZip)
                }
            },

            insertCurrentChatTitle : function(current_title){
                if(current_title.profile.upload_photo==''){
                    var current_arent_photo = 'male.png';
                }else{
                    var current_arent_photo = current_title.profile.upload_photo;
                }
                var current_arent_photo = current_title.profile.upload_photo ? current_title.profile.upload_photo : 'male.png';
                var current_date = new Date();
                var city =  (current_title.city != null) && 
                            (current_title.city != '') && 
                            (current_title.city != 0) ? current_title.city+',&nbsp;' : '';
                var state = (current_title.state != null) && 
                            (current_title.state != '') && 
                            (current_title.state != 0) ? current_title.state+'&nbsp;' : '';
                var stateCode = (current_title.state_code != null) &&
                            (current_title.state_code != '') &&
                            (current_title.state_code != 0) ? current_title.state_code : '';
                var zipcode =   (current_title.zip != null) && 
                                (current_title.zip != '') && 
                                (current_title.zip != 0) ? current_title.zip : '';
                var phone_office =  (current_title.profile.phone_office != null) && 
                                    (current_title.profile.phone_office != '') && 
                                    (current_title.profile.phone_office != 0) ? '<abbr title=\"Phone\">P:&nbsp;</abbr>'+current_title.profile.phone_office : '';

                this.checkZipCode(current_title.city, stateCode, zipcode);

                var current_agent_office_logo;
                var ext = ['.png','.jpg','.gif','.jpeg'];
                var ext_f = Chat.strrpos(current_title.profile.office_logo, '.');
                if(ext_f){
                    var sub_ext_f = current_title.profile.office_logo.substr(ext_f);
//                    if(Chat.in_array(sub_ext_f, ext)){
//                        current_agent_office_logo = current_title.profile.office_logo;
//                    }
                }
                
                var office = (current_title.profile.office!= null) ? current_title.profile.office : '';

                var website_url;

                if( (current_title.profile.website_url != null)
                   && (current_title.profile.website_url != '')
                   && (current_title.profile.website_url != 0)
                ){
                    if(current_title.profile.website_url.toLowerCase().indexOf('http') == 0){
                        website_url = '<a href=\"'+current_title.profile.website_url+'\">'+office+' website</a>';
                    }
                    else{
                        website_url = '<a href=\"http://'+current_title.profile.website_url+'\">'+office+' website</a>';
                    }
                }else{
                    website_url = '';
                }
                var hi_name = (current_title.profile.first_name != null) && 
                              (current_title.profile.first_name != '') && 
                              (current_title.profile.first_name != 0) ? 'Hi '+current_title.profile.first_name+',' : '';
                           
                var typeText = Chat.property_type == 9 ? 'rent' : 'sale'; 
                switch (Chat.property_status){
                    case 'HISTORY' || 'SOLD' || 'NOT FOR SALE' || 'PENDING':
                        message = '\"Thank you for checking out '+this.property_street+'. Contact me for information on homes for ' + typeText + ' in the area!\"';
                        placeholder = hi_name+' I would like more information on homes for ' + typeText + ' in the area that are similar to '+this.property_street+'…';
                        break;
                    case 'FOR SALE'|| 'ACTIVE' || 'EXCLUSITE':
                        message = '\"Thank you for checking out '+this.property_street+'. Please contact me if you have any questions!\"';
                        placeholder = hi_name+' I am interested in '+this.property_street+'and would like more information on the listing';
                        break;
                    default:
                        message = '\"Thank you for checking out '+this.property_street+'. Contact me for information on homes for ' + typeText + ' in the area!\"';
                        placeholder = hi_name+' I would like more information on homes for ' + typeText + ' in the area that are similar to '+this.property_street+'…';            
                }
                var online =  current_title.user == 'yes' ? 'online' : '';
                if(online=='online'){
                    $('#chat_button_li').css('display','list-item');
                    $('#chat_button_li a').trigger('click');
                } else { 
                    $('#message_button_li a').trigger('click'); 
                }
                var first_name =    (current_title.profile.first_name != null) && 
                                    (current_title.profile.first_name != '') && 
                                    (current_title.profile.first_name != 0) ? current_title.profile.first_name : '';
                var last_name = (current_title.profile.last_name != null) && 
                                (current_title.profile.last_name != '') && 
                                (current_title.profile.last_name != 0) ? current_title.profile.last_name : '';
                var street_address =    (current_title.profile.street_address != null) &&
                                        (current_title.profile.street_address != '') &&
                                        (current_title.profile.street_address != 0) ? current_title.profile.street_address : '';
                $('.current-agent-chat-title').attr('data-current_agent_mid',current_title.profile.mid);
             
                $('.current-agent-chat-title').empty().html('<li class=\"message agent\">'+
                            '<img src=\"" . (!empty(Yii::app()->params['cdnImages'])?Yii::app()->params['cdnImages']:'') . "/images/avatars/'+current_arent_photo+'\" class=\"'+online+'\" alt=\"\" width=\"50\">'+
                            '<div class=\"message-text\">'+
                                '<time>'+current_date.getFullYear()+'-'+current_date.getMonth()+'-'+current_date.getDate()+'</time>'+
                                '<a href=\"javascript:void(0);\" class=\"username\">'+first_name+' '+last_name+'</a>'+
                                '<address>'+
                                    '<strong>'+office+'</strong><br>'+street_address+
                                    '<br><citystatezip>'+city+state+zipcode+'</citystatezip><br>'+
                                    phone_office+
                                '</address>'+
                            '</div>'+
                        '</li>'+
                        '<li class=\"message broker\">'+
//                            '<img src=\"" . (!empty(Yii::app()->params['cdnImages'])?Yii::app()->params['cdnImages']:'') . "/images/office_logo/'+current_agent_office_logo+'\" alt=\"\" width=\"50\">' +
//                            '<div class=\"message-text\">'+
//                                '<address>'+
//                                    '<a>'+first_name+' '+last_name+' profile</a>'+
//                                    '<br>'+
//                                    website_url+
//                                '</address>'+
//                            '</div>'+
//                                '<br>'+
                                message+
                        '</li>');
                $('#textarea-expand').attr('placeholder',placeholder);
            },
            
            scrollBottom : function(){
                $('#chat-body').scrollTop($('#chat-body').get(0).scrollHeight);
            },
            sendMessage : function(text_message, owner_room, collocutor, m_type){
                $.ajax({
                    url: '/property/messages',
                    data: {
                            message : text_message,
                            owner_room: owner_room, 
                            collocutor: collocutor,
                            m_type: m_type
                    },
                    type: 'POST',
                    dataType: 'json',
                    cache: false,
                    success: function(data){Chat.loadSuccess(data)},
                    error: Chat.loadError()
                });
            },
            loadMessages : function(room_owner_id, collocutor_id){
                
                $.ajax({
                    url: '/property/messages',
                    data: {
                            owner_room: room_owner_id, 
                            collocutor: collocutor_id 
                    },
                    type: 'POST',
                    dataType: 'json',
                    cache: false,
                    success: function(data){Chat.loadSuccess(data)},
                    error: Chat.loadError()
                });
            },
            
            loadSuccess : function(data){
                
                Chat.renderMessages(data);
                Chat.scrollBottom();
            },
            
            renderMessages : function(data){
                if(Chat.current_user_id != 0){
                    var html = '', current_user_avatar, first_name, last_name;
                    for(var i = 0; i < data.messages.length; i++){
                        var message = data.messages[i];
                        if(message.message.author_id == Chat.current_user_id){
                            current_user_avatar = Chat.property_agents_info.current_user.profile.upload_photo ? 
                                Chat.property_agents_info.current_user.profile.upload_photo : 'male.png';
                            first_name = Chat.property_agents_info.current_user.profile.first_name;
                            last_name = Chat.property_agents_info.current_user.profile.last_name;
                        } else {
                            current_user_avatar = Chat.chat_users[message.message.author_id].profile.upload_photo ? 
                                Chat.chat_users[message.message.author_id].profile.upload_photo : 'male.png';
                            first_name = Chat.chat_users[message.message.author_id].profile.first_name;
                            last_name = Chat.chat_users[message.message.author_id].profile.last_name;
                        }
                        html += '<li class=\"message\">'+
                                    '<img class=\"online\" src=\"/images/avatars/'+current_user_avatar+'\" alt=\"\" width=\"50\">'+
                                    '<div class=\"message-text\">'+ 
                                        '<a>'+first_name+' '+last_name+'</a>'+
                                    '</div>'+
                                        '<br>'+message.message.chat_message+
                                '</li>';
                        //var chat_owner_avatar = Chat.current_agent.profile.upload_photo ? Chat.current_agent.profile.upload_photo : 'male.png';
                    }
                    $('#js-chat-messages').empty().html(html);
                }
            },
            
            clearTextareaExpand : function(){
                Chat._this.find('#textarea-expand').empty().val('');
            },
            
            loadError : function (){
                Chat.proceedError('Server respond with error. Please, try again later.');
            },
            
            proceedError : function(message){
                var errorEl = Chat._this.find('.js-chat-error'),
                    errorMessage = message || 'Somwthing was wrong!';
                errorEl.text(errorMessage).slideDown();
                //Chat._this.find('#textarea-expand').focus();
                setTimeout(function(){errorEl.slideUp();}, 2000);
            },
            
            startInterval : function(room_owner_id, collocutor_id){
                
                Chat.interval = setInterval(function(){
//                    console.log('Interval');
                    Chat.loadMessages(room_owner_id, collocutor_id);
                }, Chat.delay);
            },
            
            stopInterval : function(){
//                console.log('stopInterval');
                clearInterval(Chat.interval);
            },
        
        }; ", CClientScript::POS_END);
