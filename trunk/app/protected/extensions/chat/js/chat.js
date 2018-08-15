var chatWidget; 
var property_agents_info;
(function($){
    $(document).ready(function(){
        
        
        var ChatWidget = function(){
            this.el = '.js-chat-widget';
            this.el$ = $(this.el);
            this.delay = $(this.el).data('delay') || 5000;
            this.maxMsgLength = $(this.el).data('maxmsglength') || 150;
            this.property_id = $(this.el).data('property_id') || 0;
            this.owner_mid = $(this.el).data('owner_mid') || 0;
            this.property_zipcode = $(this.el).data('property_zipcode') || 0;
            this.current_agent_mid = $(this.el).data('current_agent_mid') || 0;
            this.property_status = $(this.el).data('property_status') || 0;
            this.property_street = $(this.el).data('property_street') || 0;
            
    
            this.init();
        };
        ChatWidget.prototype.init = function(){
            //this.bindEvents();
           
            this.loadMessagesFistTime();
            //this.startInterval();
        };
        ChatWidget.prototype.bindEvents = function(){
            var that = this;
            //this.el$.find('.js-chat-toggle').on('click', {self: this}, this.toggle); 
            this.el$.find('.js-chat-form').submit(function(event){
                that.submitForm();
                event.preventDefault();
                return false;
            });
        };
        ChatWidget.prototype.submitForm = function(event){
            this.sendMessage();
        };
        ChatWidget.prototype.loadMessages = function(){
            $.ajax({
                url: '/property/chat',
                data: {action: 'get',
                       owner_mid: this.owner_mid,
                       property_zipcode: this.property_zipcode
                   },
                type: 'POST',
                dataType: 'json',
                cache: false,
                success: this.loadSuccess,
                error: this.loadError
            });
        };

         ChatWidget.prototype.loadMessagesFistTime = function(){
            $.ajax({
                url: '/property/chat',
                data: {action: 'get',
                       owner_mid: this.owner_mid,
                       property_zipcode: this.property_zipcode
                   },
                type: 'POST',
                dataType: 'json',
                cache: false,
                success: this.loadSuccessFirstTime,
                error: this.loadError
            });
        };
        ChatWidget.prototype.loadSuccessFirstTime = function(data){
            chatWidget.property_agents_info = data; 
            
            chatWidget.clearChatMessages();
            chatWidget.loadListChatRooms(data);
            chatWidget.insertCurrentChatTitle(data);
            chatWidget.scrollBottom();
        };
        ChatWidget.prototype.clearChatMessages = function(){
            $('#agent_count_flag').empty();
        };
        ChatWidget.prototype.disableInput = function(){
            this.el$.find('.js-chat-submit').attr('disabled', 'disabled');
            this.el$.find('#textarea-expand').attr('disabled', 'disabled');
        };
        ChatWidget.prototype.enableInput = function(){
            this.el$.find('.js-chat-submit').removeAttr('disabled');
            this.el$.find('#textarea-expand').removeAttr('disabled');
        };
        ChatWidget.prototype.clearInput = function(){
            this.el$.find('#textarea-expand').val('');
        };
        ChatWidget.prototype.loadSuccess = function(data){
            chatWidget.renderMessages(data);
            chatWidget.scrollBottom();
        };
        ChatWidget.prototype.loadError = function (){
            chatWidget.proceedError("Server respond with error. Please, try again later.");
        };
        ChatWidget.prototype.loadListChatRooms = function(data){
            $('#chat-users').empty();
            var flag_count = 0;
            var limitation_advertising_agents = data.advertising_agents_list.length < 4 ? data.advertising_agents_list.length : 4;
            if(limitation_advertising_agents > 0){
                for(var i = 0; i < limitation_advertising_agents; i++){
                    var agent = data.advertising_agents_list[i];
                    var agent_photo = agent.upload_photo ? agent.upload_photo : 'male.png';
                    $('#chat-users').append('<li><a href="javascript:void(0);" data-mid="'+agent.mid+'" data-kind="advertising_agents_list" data-index="'+i+'">'+
                                                    '<img src="/images/avatars/'+agent_photo+'" alt="">'+agent.first_name+'&nbsp;'+
                                                        agent.last_name+'<span class="label label-success pull-right">'+agent.rating_average+' Stars</span></a></li>');
                     
                }
                flag_count += i;
            }
            if(data.owner.length > 0){
                for(var n = 0; n < data.owner.length; n++){
                    var owner = data.owner[n];
                    var owner_photo = owner.upload_photo ? owner.upload_photo : 'male.png';
                    $('#chat-users').append('<li><a href="javascript:void(0);" data-mid="'+owner.mid+'" data-kind="owner" data-index="'+n+'">'+
                                                '<img src="/images/avatars/'+owner_photo+'" alt="">'+owner.first_name+'&nbsp;'+
                                                    owner.last_name+'<span class="label label-primary pull-right">Agent</span></a></li>');
                }
                flag_count += n;
            }
            
                                            
            
            if(data.saved_agents.length > 0){
                for (var j=0; j < data.saved_agents.length; j++){
                    var save_agent = data.saved_agents[j];
                    var saved_agent_photo = save_agent.upload_photo ? save_agent.upload_photo : 'male.png';
                    $('#chat-users').append('<li>'+
                            '<a href="javascript:void(0);" data-mid="'+save_agent.mid+'" data-kind="saved_agents" data-index="'+j+'">'+
                                '<img src="/images/avatars/'+saved_agent_photo+'" alt="">'+
                                save_agent.first_name+'&nbsp;'+save_agent.last_name+
                                '<span class="label label-info pull-right">Saved</span></a></li>');
                }
                flag_count += j;
            }
            if(data.max_rating.length > 0){
                for (var k=0; k < data.max_rating.length; k++){
                    var max_rating_agent = data.max_rating[k];
                    var max_rating_photo = max_rating_agent.upload_photo ? max_rating_agent.upload_photo : 'male.png';
                    $('#chat-users').append('<li>'+
                            '<a href="javascript:void(0);" data-mid="'+max_rating_agent.mid+'" data-kind="max_rating" data-index="'+k+'">'+
                                '<img src="/images/avatars/'+max_rating_photo+'"'+ 
                                     'alt="">'+max_rating_agent.first_name+' '+max_rating_agent.last_name+'<span class="label label-success pull-right">'+max_rating_agent.rating_average+' Stars</span></a>'+
                        '</li>');
                }
                flag_count += k;
            }
            
            $('#agent_count_flag').empty().html(flag_count);
            
            
        };
        ChatWidget.prototype.renderMessages = function(data){
            if(data.agents_list.length != 0){
                //$('#chat-users').empty();
                
                
              
            }
            var date, username, target$ = this.el$.find('.js-chat-messages');
            
           
//            $(data).each(function(){
//                username = this.username || 'Guest';
//                date = new Date(this.chat_created * 1000);
//                target$.append('<li><span class="chat-time">' + 
//                        ("0" + date.getDate()).slice(-2) + '/' + 
//                        ("0" + date.getMonth()).slice(-2) + '/' + 
//                        date.getFullYear() + ' ' + 
//                        ("0" + date.getHours()).slice(-2) + ':' + 
//                        ("0" + date.getMinutes()).slice(-2) + '</span> <span class="chat-name">' + username + '</span>: ' + this.chat_message + '</li>');
//            });
        };
        ChatWidget.prototype.insertCurrentChatTitle = function(data){
            var current_agent = $('#chat-users li:eq(0) a');
            var kind_agent = current_agent.data('kind');
            var agent_mid = current_agent.data('mid');
            var agent_index = current_agent.data('index');
            var current_title = data[kind_agent][agent_index];
            var current_arent_photo = current_title.upload_photo ? current_title.upload_photo : 'male.png';
            var current_date = new Date();
            var city = current_title.city != null || '' ? current_title.city+',&nbsp;' : '';
            var state = current_title.state != null || '' ? current_title.state+'&nbsp;' : '';
            var zipcode = current_title.zipcode != null || '' ? current_title.zipcode : '';
            var phone_office = current_title.phone_office != null || '' ? '<abbr title="Phone">P:&nbsp;</abbr>'+current_title.phone_office : '';
            var current_agent_office_logo = current_title.office_logo ? current_title.office_logo : 'male.png'; 
            var website_url = current_title.website_url != null || '<a href="'+current_title.website_url+'">'+current_title.office+' website</a>' ? '' : '';
            switch (this.property_status){
                case 'HISTORY' || 'SOLD' || 'NOT FOR SALE' || 'PENDING':
                    message = 'Thank you for checking out '+this.property_street+'. Please contact me if you have any questions!';
                    placeholder = 'Hi Jan, I am interested in '+this.property_street+'. and would like more information on the listing';
                    break;
                    
                case 'FOR SALE'|| 'ACTIVE' || 'EXCLUSITE':
                    message = 'Thank you for checking out '+this.property_street+'. Contact me for information on homes for sale in the area!';
                    placeholder = 'Hi Jan, I would like more information on homes for sale in the area that are similar to '+this.property_street+'…';
                    break;
                    
                default:
                    message = 'Thank you for checking out '+this.property_street+'. Contact me for information on homes for sale in the area!';
                    placeholder = 'Hi Jan, I would like more information on homes for sale in the area that are similar to '+this.property_street+'…';
            }
            
            $('.current-agent-chat-title').empty().html('<li class="message">'+
                        '<img src="/images/avatars/'+current_arent_photo+'" class="online" alt="" width="50">'+
                        '<div class="message-text">'+
                            '<time>'+current_date.getFullYear()+'-'+current_date.getMonth()+'-'+current_date.getDate()+'</time>'+
                            '<a href="javascript:void(0);" class="username">'+current_title.first_name+' '+current_title.last_name+'</a>'+
                            '<address>'+
                                '<strong>'+current_title.office+'</strong><br>'+current_title.street_address+
                                '<br>'+city+state+zipcode+'<br>'+
                                phone_office+
                            '</address>'+
                        '</div>'+
                    '</li>'+
                    '<li class="message">'+
                        '<img src="/images/office_logo/'+current_agent_office_logo+'" alt="" width="50">'+
                        '<div class="message-text">'+
                            '<address>'+
                                '<a>'+current_title.first_name+' '+current_title.last_name+' profile</a><br>'+
                                website_url+
                            '</address>'+
                        '</div>'+
                            '<br>"'+message+'"'+
                    '</li>');
            $('#textarea-expand').attr('placeholder',placeholder);
        };
        ChatWidget.prototype.startInterval = function(){
            var that = this;
            this.interval = setInterval(function(){
                that.loadMessages();
            }, this.delay);
        };
        ChatWidget.prototype.stopInterval = function(){
            clearInterval(this.interval);
        };
        ChatWidget.prototype.getMessage = function(){
            return this.el$.find('#textarea-expand').val();
        };
        ChatWidget.prototype.proceedError = function(message){
            var errorEl$ = this.el$.find('.js-chat-error'),
                errorMessage = message || "Somwthing was wrong!";
            errorEl$.text(errorMessage).slideDown();
            this.el$.find('#textarea-expand').focus();
            setTimeout(function(){
                errorEl$.slideUp();
            }, 2000);
        };
        ChatWidget.prototype.validateMessage = function(message){
            return message && message !== '' && message.length <= this.maxMsgLength;
        };
        ChatWidget.prototype.sendMessage = function(){
            var message = this.getMessage();
            if (this.validateMessage(message)) {
                this.disableInput();
                this.stopInterval();
                $.ajax({
                    url: '/property/chat',
                    data: {message: message, action: 'post'},
                    dataType: 'json',
                    type: 'POST',
                    success: this.messageSuccess,
                    error: this.messageError
                });
            } else {
                this.proceedError("Type your message, before submit.");
            }
        };
        ChatWidget.prototype.messageError = function(){
            chatWidget.proceedError("Server respond with error. Please, try again later.");
        };
        ChatWidget.prototype.messageSuccess = function(data){
            chatWidget.renderMessages(data);
            chatWidget.scrollBottom();
            chatWidget.enableInput();
            chatWidget.clearInput();
            chatWidget.startInterval();
            chatWidget.el$.find('#textarea-expand').focus();
        };
        ChatWidget.prototype.scrollBottom = function(){
            //this.el$.find('.js-chat-messages').scrollTop(this.el$.find('.js-chat-messages').get(0).scrollHeight);
        };
        
        ChatWidget.prototype.toggle = function(event){
            var context = event.data.self;
            if (context.el$.data('visible')) {
                context.el$.animate({right: -context.el$.width()});
                context.el$.data('visible', false);
                context.el$.find('.js-chat-toogle-icon').html('<');
            }else {
                context.el$.animate({right: 0}, function(){
                    context.el$.data('visible', true);
                    context.el$.find('#textarea-expand').focus();
                    context.el$.find('.js-chat-toogle-icon').html('>');
                });
            }
        };
    
    
      chatWidget = new ChatWidget();
      console.log(chatWidget);
    });
})(jQuery);
