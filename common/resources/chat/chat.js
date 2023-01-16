(function($){

    function Chat(){

        this.id = null;
        this.container = null;
        this.files_container = null;
        this.user = null;
        this.sendUrl = null;
        this.updateUrl = null;
        this.messages = [];
        this.files = [];
        this.msg_autoscroll = true;
        this.fls_autoscroll = true;

        this.templates = {
            body: '<div class="lk_user_body_chat">\n' +
            '    <div class="row">\n' +
            '        <div class="col-md-8">\n' +
            '            <h3>Чат с экспертом</h3>\n' +
            '            <div class="c_body c_body_messages">\n' +
            '            </div>\n' +
            '        </div>\n' +
            '        <div class="col-md-4">\n' +
            '            <h3>Отчеты</h3>\n' +
            '            <div class="c_body c_body_files">\n' +
            '            </div>\n' +
            '        </div>\n' +
            '    </div>\n' +
            '    <br>\n' +
            '    <form>\n' +
            '    <div class="row">\n' +
            '        <div class="col-md-12">\n' +
            '                <div class="f_group mb10">\n' +
            '                    <label for="">Написать сообщение</label>\n' +
            '                    <textarea name="message" type="text" placeholder="Введите текст" required=""></textarea>\n' +
            '                </div>\n' +
            '        </div>\n' +
            '    </div>\n' +
            '    <div class="c_body_message_send">\n' +
            '        <div class="row text-right">\n' +
            '            <div class="col-md-12">\n' +
            '                <a class="button button_orange button_top_img send-chat-message" href="">отправить</a>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '    </div>\n' +
            '    </form>\n' +
            '</div>',
            self:
            '                <div class="c_body_message_wrapper c_body_message_wrapper_self">\n' +
            '                    <div class="c_body_message_info">19:00</div>\n' +
            '                    <div class="c_body_message c_body_message_self">'+
            '                    </div>\n' +
            '                </div>\n',
            opponent:
            '                <div class="c_body_message_wrapper c_body_message_wrapper_second">\n' +
            '                    <div class="c_body_message c_body_message_second">Пвсе.</div>\n' +
            '                    <div class="c_body_message_info">19:00</div>\n' +
            '                </div>\n',
            file: '<div class="c_rew_body_message">\n' +
            '                    <div class="c_rew_body_message_img">\n' +
            '                        <img src="img/rew.png" alt="">\n' +
            '                    </div>\n' +
            '                    <div class="c_rew_body_message_name">\n' +
            '                        <span>Отчет №3.1</span>\n' +
            '                    </div>\n' +
            '                    <div class="c_rew_body_message_link">\n' +
            '                        <a href="">https://www.google.c...</a>\n' +
            '                    </div>\n' +
            '                </div>'
        };

        this.getLastMessage = function(){
            let max = 0;
            this.messages.forEach(function(element, id){
                if(id > max) max = id;
            });
            return max;
        };

        this.lastFile = function(){
            let max = 0;
            this.files.forEach(function(element, id){
                if(id > max) max = id;
            });
            return max;
        };

        this.close = function(){
            clearInterval(this.timer);
            this.container.html('');
        };
        this.open = function(){
        };
        this.init = function(options){
            this.id = options.id;
            this.container = $(options.container);
            this.user = options.user;
            this.sendUrl = options.sendUrl;
            this.updateUrl = options.updateUrl;
            this.container.html(this.templates.body);
            this.body = this.container.find('.c_body_messages');
            this.files_container = this.container.find('.c_body_files');
            this.addEvents();
            let that = this;
            this.timer = setInterval(function(){
                that.update();
            }, 5000);
            this.body.niceScroll();
            this.files_container.niceScroll();

        };
        this.error = function(data){
            clearInterval(this.timer);
            this.container.html(data.message);
        };
        this.update = function(callback = null){
            let chat = this;
            $.get(chat.updateUrl, {
                user_id: chat.user,
                chat_id: chat.id,
                last_message: this.getLastMessage(),
                last_file: this.lastFile()
            }, function(response){
                if(response.ok){

                    chat.add(response.messages);
                    chat.addFiles(response.files);

                    if(callback != null)
                        callback();
                } else {
                    chat.error(response)
                }

            }, 'json');
        };
        this.addEvents = function(){
            let chat = this;

            this.body.scroll(function(){
                let area = chat.body.get(0);
                chat.msg_autoscroll = (area.scrollHeight - $(area).height()) == area.scrollTop;
            });

            this.files_container.scroll(function(){
                let area = chat.files_container.get(0);
                chat.fls_autoscroll = (area.scrollHeight - $(area).height()) == area.scrollTop;
            });

            this.container.on('click', '.send-chat-message', function(e){
                e.preventDefault();
                let textarea = $(this).closest('form').find('textarea[name=message]');
                let message = textarea.val();
                textarea.val('');
                $.post(chat.sendUrl, {
                    chat: chat.id,
                    user: chat.user,
                    message: message
                }, function(response){
                    if(response.ok) {
                        chat.update();
                    }
                    console.log(response);
                } ,'json');
            });
        };

        this.add = function(messages){
            let chat = this;
            messages.forEach(function(value){
                if(value.id in chat.messages) {
                    return;
                }
                chat.messages[value.id] = value;
                chat.render(value);
            });
            if(this.msg_autoscroll){
                let scroll = this.body.get(0).scrollHeight;
                this.body.animate({ scrollTop: scroll}, 500);
            }
        };

        this.addFiles = function(files){
            let chat = this;
            files.forEach(function(value){
                if(value.id in chat.files) {
                    return;
                }
                chat.files[value.id] = value;
                chat.renderFile(value);
            });
            if(this.fls_autoscroll){
                let scroll = this.files_container.get(0).scrollHeight;
                this.files_container.animate({ scrollTop: scroll }, 500);
            }

        };

        this.renderFile = function(file){
            let template = this.templates.file;
            let $file = $(template);
            $file.find('.c_rew_body_message_img img').html(file.image);
            $file.find('.c_rew_body_message_name').html(file.title);
            $file.find('.c_rew_body_message_link a').html("открыть");
            $file.find('.c_rew_body_message_link a').attr('href', file.dest );
            $file.appendTo(this.files_container);
        };

        this.render = function(message){
            let template = message.author_id == this.user ?
                this.templates.self : this.templates.opponent;
            let $message = $(template);
            $message.find('.c_body_message').html(message.text);
            $message.find('.c_body_message_info').html(message.time);
            $message.appendTo(this.body);

        }

    }


    $.fn.OpenChat = function(options){
        let chat = new Chat();
        options.container = this;
        chat.init(options);
        $(this).data('chat', chat);
        chat.update();
    };

    $.fn.closeChat = function(){
        let chat = $(this).data('chat');
        if(chat) chat.close();
    };


})(jQuery);