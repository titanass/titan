$(document).ready(function() {
    outdatedBrowser({
        bgColor: '#f25648',
        color: '#ffffff',
        lowerThan: 'transform',
        languagePath: 'outdatedbrowser/lang/en.html'
    });
    $.backstretch("img/background.jpg");
    $('.generator-form .cc-username-wrap').animateCSS("bounceInUp", {
        delay: 100
    });
    $('.generator-form .cc-device-wrap').animateCSS("bounceInUp", {
        delay: 100
    });
    $('.generator-form .cc-gems-wrap').animateCSS("bounceInUp", {
        delay: 300
    });
    $('.generator-form .cc-gold-wrap').animateCSS("bounceInUp", {
        delay: 300
    });
    $('.generator-form .cc-elixir-wrap').animateCSS("bounceInUp", {
        delay: 300
    });
    $('.generator-form .cc-btn-wrap').animateCSS("bounceInUp", {
        delay: 500
    });
    var messages = ['<img src="img/coins.PNG" style="max-height: 15px;"/> 50,000 Münzen generiert!', '<img src="img/coins.PNG" style="max-height: 15px;"/> 80,000 Münzen generiert!', '<img src="img/coins.PNG" style="max-height: 15px;"/> 25,500 Münzen generiert!', '<img src="img/coins.PNG" style="max-height: 15px;"/> 65,000 Münzen generiert!', '<img src="img/coins.PNG" style="max-height: 15px;"/> 99,999 Münzen generiert!', 'seine <img src="img/gems.PNG" style="max-height: 15px;"/> Toads zu 10.000 aufgefüllt!', 'seine <img src="img/gems.PNG" style="max-height: 15px;"/> Toads zu 99.999 aufgefüllt!', 'seine <img src="img/gems.PNG" style="max-height: 15px;"/> Toads zu 50.000 aufgefüllt!', 'seine <img src="img/raffle-tickets.PNG" style="max-height: 15px;"/> Raffle Tickets zu 99.999 aufgefüllt!', 'seine <img src="img/raffle-tickets.PNG" style="max-height: 15px;"/> Raffle Tickets zu 99.999 aufgefüllt!', 'seine <img src="img/raffle-tickets.PNG" style="max-height: 15px;"/> Raffle Tickets zu 5000 aufgefüllt!', ];
    changeUpdateMessage();
    timer = new Date().valueOf() + (5 * 60 * 1000);
    $(".timer").countdown(timer.toString(), function(event) {
        $(this).text(event.strftime('%M:%S'))
    });
    var gems_stat = getRandomInt(25432, 123993);
    var gold_stat = getRandomInt(26757, 169726);
    var elixir_stat = getRandomInt(22561, 172578);
    $('.coc-gem-stat').text(gems_stat);
    $('.coc-gold-stat').text(gold_stat);
    $('.coc-elixir-stat').text(elixir_stat);
    setInterval(function() {
        gems_stat = gems_stat + getRandomInt(17483, 123993);
        gold_stat = gold_stat + getRandomInt(26757, 169726);
        elixir_stat = elixir_stat + getRandomInt(22561, 172578);
        $('.coc-gem-stat').fadeOut().text(gems_stat).fadeIn();
        $('.coc-gold-stat').fadeOut().text(gold_stat).fadeIn();
        $('.coc-elixir-stat').fadeOut().text(elixir_stat).fadeIn();
        $('.updates-box .coc-update-msg').animateCSS("fadeOutUp", {
            delay: 0,
            callback: function() {
                $('.updates-box .coc-update-msg').css('visibility', 'hidden');
                changeUpdateMessage();
                $('.updates-box .coc-update-msg').animateCSS("fadeInUp")
            }
        })
    }, getRandomInt(2000, 7000));

    function changeUpdateMessage() {
        var msg = faker.internet.userName() + ' hat ' + messages[getRandomInt(0, 10)];
        $('.updates-box .coc-update-msg .message').html(msg)
    }
    $('.generate-btn').on('click', function() {
        if ($('#ccUsername').val() != '') {
            confirmDialogOpen($('#ccGems select').val(), $('#ccGold select').val(), $('#ccElixir select').val(), function() {
                $('.generator-form .cc-username-wrap').animateCSS("bounceOutUp", {
                    delay: 100,
                    callback: function() {
                        $(this).hide()
                    }
                });
                $('.generator-form .cc-device-wrap').animateCSS("bounceOutUp", {
                    delay: 100,
                    callback: function() {
                        $(this).hide()
                    }
                });
                $('.generator-form .cc-gems-wrap').animateCSS("bounceOutUp", {
                    delay: 300,
                    callback: function() {
                        $(this).hide()
                    }
                });
                $('.generator-form .cc-gold-wrap').animateCSS("bounceOutUp", {
                    delay: 300,
                    callback: function() {
                        $(this).hide()
                    }
                });
                $('.generator-form .cc-elixir-wrap').animateCSS("bounceOutUp", {
                    delay: 300,
                    callback: function() {
                        $(this).hide()
                    }
                });
                $('.generator-form .cc-btn-wrap').animateCSS("bounceOutUp", {
                    delay: 500,
                    callback: function() {
                        $(this).hide();
                        var vh_height = $(window).width();
                        var new_height = 430;
                        if (vh_height <= 800) {
                            new_height = 550
                        }
                        $('.generator-form').animate({
                            height: new_height
                        }, "fast", function() {
                            $('.generator-form .step-two').show();
                            $('.generator-form .step-two').flexVerticalCenter({
                                parentSelector: '.generator-form'
                            });
                            $('.generator-form .step-two .loader-wrap').animateCSS("bounceInUp", {
                                delay: 100
                            });
                            $('.generator-form .step-two .loader-msg').animateCSS("bounceInUp", {
                                delay: 100
                            });
                            $('.generator-form .step-two .generator-console').animateCSS("bounceInUp", {
                                delay: 300,
                                callback: function() {
                                    startConsoleAnimation(function() {
                                        $.magnificPopup.open({
                                            items: {
                                                src: '#gen_modal',
                                            },
                                            type: 'inline',
                                            preloader: false,
                                            modal: true,
                                            callbacks: {
                                                open: function() {}
                                            }
                                        })
                                    })
                                }
                            })
                        })
                    }
                })
            })
        } else {
            sweetAlert("Error", "Please enter your Titanfall Assault Username.", "error")
        }
    });

    function confirmDialogOpen(gems, gold, elixir, callback) {
        bootbox.dialog({
            message: "<p>Do you want to add the selected resources below to your Titanfall Assault Account?</p><p><img src='img/coins.PNG' height='20px'/> " + gems + ".</p><p><img src='img/gems.PNG' height='20px'/> " + gold + ".</p><p><img src='img/raffle-tickets.PNG' height='20px'/> " + elixir + ".</p><p>Click Continue to get them now!</p>",
            title: "Please confirm",
            buttons: {
                main: {
                    label: "Cancel",
                    className: "btn-default",
                    callback: function() {
                        bootbox.hideAll()
                    }
                },
                success: {
                    label: "Continue",
                    className: "btn-success",
                    callback: function() {
                        bootbox.hideAll();
                        callback()
                    }
                }
            }
        })
    }
    $('.generator-console').on('DOMSubtreeModified', function() {
        $(".generator-console").scrollTop($(".generator-console")[0].scrollHeight)
    });

    function startConsoleAnimation(callback) {
        $('.generator-console').dynatexer({
            loop: 1,
            content: [{
                animation: 'additive',
                delay: 0,
                placeholder: '<span class="console_text white">',
                render_strategy: 'text-one-shot',
                items: "[root@28.3.4.53.2]$ "
            }, {
                animation: 'additive',
                delay: 5,
                placeholder: '<span class="console_text white">',
                render_strategy: 'text-by-char',
                items: "open_ssl_connection titanfall_assault -s 28.3.4.53.2 -deobfuscate -encrypt_aes_256"
            }, {
                delay: 200
            }, {
                animation: 'additive',
                delay: 5,
                placeholder: '<span class="console_text blue">',
                render_strategy: 'text-one-shot',
                items: "\nOpening port 423245.\n"
            }, {
                animation: 'replace',
                delay: 3,
                placeholder: '<span class="console_text yellow">',
                render_strategy: 'iterator',
                items: $().dynatexer.helper.counter({
                    start: 1,
                    end: 100,
                    step: 1,
                    mask: '%d%'
                })
            }, {
                animation: 'additive',
                delay: 50,
                placeholder: '<span class="console_text green">',
                render_strategy: 'text-one-shot',
                items: "\nPort 423245 geöffnet."
            }, {
                animation: 'additive',
                delay: 50,
                placeholder: '<span class="console_text blue">',
                render_strategy: 'text-one-shot',
                items: "\nEncrypting Connection: open_ssl_aes256(28.3.4.53.2);\n"
            }, {
                animation: 'replace',
                delay: 10,
                render_strategy: 'iterator',
                placeholder: '<span class="console_text yellow">',
                items: $().dynatexer.helper.counter({
                    start: 1,
                    end: 100,
                    step: 1,
                    mask: '%d%'
                })
            }, {
                animation: 'additive',
                delay: 50,
                placeholder: '<span class="console_text green">',
                render_strategy: 'text-one-shot',
                items: "\nConnection Encrypted."
            }, {
                animation: 'additive',
                delay: 0,
                placeholder: '<span class="console_text white">',
                render_strategy: 'text-one-shot',
                items: "\n[root@28.3.4.53.2]$ "
            }, {
                animation: 'additive',
                delay: 5,
                placeholder: '<span class="console_text white">',
                render_strategy: 'text-by-char',
                items: "importing data from /usr/ect/kernel/server/config.json"
            }, {
                delay: 100
            }, {
                animation: 'additive',
                delay: 5,
                placeholder: '<span class="console_text blue">',
                render_strategy: 'text-one-shot',
                items: "\nImporting config.json\n"
            }, {
                animation: 'replace',
                delay: 5,
                placeholder: '<span class="console_text yellow">',
                render_strategy: 'iterator',
                items: $().dynatexer.helper.counter({
                    start: 1,
                    end: 100,
                    step: 1,
                    mask: '%d%'
                })
            }, {
                animation: 'additive',
                delay: 5,
                placeholder: '<span class="console_text green">',
                render_strategy: 'text-one-shot',
                items: "\n‘config.json’ imported."
            }, {
                animation: 'additive',
                delay: 5,
                placeholder: '<span class="console_text blue">',
                render_strategy: 'text-one-shot',
                items: "\nServer Configuration set to Read Only.\n"
            }, {
                animation: 'replace',
                delay: 3,
                placeholder: '<span class="console_text yellow">',
                render_strategy: 'iterator',
                items: $().dynatexer.helper.counter({
                    start: 1,
                    end: 100,
                    step: 1,
                    mask: '%d%'
                })
            }, {
                animation: 'additive',
                delay: 5,
                placeholder: '<span class="console_text green">',
                render_strategy: 'text-one-shot',
                items: "\nReading Files."
            }, {
                animation: 'additive',
                delay: 5,
                placeholder: '<span class="console_text blue">',
                render_strategy: 'text-one-shot',
                items: "\nVerarbeite server configuration string.\n"
            }, {
                animation: 'replace',
                delay: 5,
                placeholder: '<span class="console_text yellow">',
                render_strategy: 'iterator',
                items: $().dynatexer.helper.counter({
                    start: 1,
                    end: 100,
                    step: 1,
                    mask: '%d%'
                })
            }, {
                animation: 'additive',
                delay: 30,
                placeholder: '<span class="console_text green">',
                render_strategy: 'text-one-shot',
                items: "\nData successfully imported."
            }, {
                animation: 'additive',
                delay: 0,
                placeholder: '<span class="console_text white">',
                render_strategy: 'text-one-shot',
                items: "\n[root@28.3.4.53.2]$ "
            }, {
                animation: 'additive',
                delay: 5,
                placeholder: '<span class="console_text white">',
                render_strategy: 'text-by-char',
                items: "edit_config -gems " + $('#ccGems select').val() + " -gold " + $('#ccGold select').val() + " -elixir " + $('#ccElixir select').val()
            }, {
                delay: 70
            }, {
                animation: 'additive',
                delay: 5,
                placeholder: '<span class="console_text blue">',
                render_strategy: 'text-one-shot',
                items: "\nOpen hash being edited.\n"
            }, {
                animation: 'replace',
                delay: 3,
                placeholder: '<span class="console_text yellow">',
                render_strategy: 'iterator',
                items: $().dynatexer.helper.counter({
                    start: 1,
                    end: 100,
                    step: 1,
                    mask: '%d%'
                })
            }, {
                animation: 'additive',
                delay: 5,
                placeholder: '<span class="console_text green">',
                render_strategy: 'text-one-shot',
                items: "\nConfigurations ist lesbar."
            }, {
                animation: 'additive',
                delay: 5,
                placeholder: '<span class="console_text blue">',
                render_strategy: 'text-one-shot',
                items: "\nChange " + $('#ccGems select').val() + ".\n"
            }, {
                animation: 'replace',
                delay: 4,
                placeholder: '<span class="console_text yellow">',
                render_strategy: 'iterator',
                items: $().dynatexer.helper.counter({
                    start: 1,
                    end: 100,
                    step: 1,
                    mask: '%d%'
                })
            }, {
                animation: 'additive',
                delay: 10,
                placeholder: '<span class="console_text green">',
                render_strategy: 'text-one-shot',
                items: "\nCoins successfully changed."
            }, {
                animation: 'additive',
                delay: 5,
                placeholder: '<span class="console_text blue">',
                render_strategy: 'text-one-shot',
                items: "\nChange " + $('#ccGold select').val() + ".\n"
            }, {
                animation: 'replace',
                delay: 3,
                placeholder: '<span class="console_text yellow">',
                render_strategy: 'iterator',
                items: $().dynatexer.helper.counter({
                    start: 1,
                    end: 100,
                    step: 1,
                    mask: '%d%'
                })
            }, {
                animation: 'additive',
                delay: 5,
                placeholder: '<span class="console_text green">',
                render_strategy: 'text-one-shot',
                items: "\nGems successfully changed."
            }, {
                animation: 'additive',
                delay: 5,
                placeholder: '<span class="console_text blue">',
                render_strategy: 'text-one-shot',
                items: "\nChange " + $('#ccElixir select').val() + ".\n"
            }, {
                animation: 'replace',
                delay: 3,
                placeholder: '<span class="console_text yellow">',
                render_strategy: 'iterator',
                items: $().dynatexer.helper.counter({
                    start: 1,
                    end: 100,
                    step: 1,
                    mask: '%d%'
                })
            }, {
                animation: 'additive',
                delay: 5,
                placeholder: '<span class="console_text green">',
                render_strategy: 'text-one-shot',
                items: "\nCard Packs successfully changed."
            }, {
                animation: 'additive',
                delay: 3,
                placeholder: '<span class="console_text blue">',
                render_strategy: 'text-one-shot',
                items: "\nClose configuration file.\n"
            }, {
                animation: 'replace',
                delay: 3,
                placeholder: '<span class="console_text yellow">',
                render_strategy: 'iterator',
                items: $().dynatexer.helper.counter({
                    start: 1,
                    end: 100,
                    step: 1,
                    mask: '%d%'
                })
            }, {
                animation: 'additive',
                delay: 10,
                placeholder: '<span class="console_text green">',
                render_strategy: 'text-one-shot',
                items: "\nConfiguration closing."
            }, {
                animation: 'additive',
                delay: 0,
                placeholder: '<span class="console_text white">',
                render_strategy: 'text-one-shot',
                items: "\n[root@28.3.4.53.2]$ "
            }, {
                animation: 'additive',
                delay: 5,
                placeholder: '<span class="console_text white">',
                render_strategy: 'text-by-char',
                items: "save_config -S -v /usr/ect/kernel/sever/config.json"
            }, {
                delay: 80
            }, {
                animation: 'additive',
                delay: 5,
                placeholder: '<span class="console_text blue">',
                render_strategy: 'text-one-shot',
                items: "\nExporting Settings.\n"
            }, {
                animation: 'replace',
                delay: 3,
                placeholder: '<span class="console_text yellow">',
                render_strategy: 'iterator',
                items: $().dynatexer.helper.counter({
                    start: 1,
                    end: 100,
                    step: 1,
                    mask: '%d%'
                })
            }, {
                animation: 'additive',
                delay: 5,
                placeholder: '<span class="console_text blue">',
                render_strategy: 'text-one-shot',
                items: "\nExporting Settings.."
            }, {
                animation: 'additive',
                delay: 5,
                placeholder: '<span class="console_text blue">',
                render_strategy: 'text-one-shot',
                items: "\nExporting Settings...\n"
            }, {
                animation: 'replace',
                delay: 4,
                placeholder: '<span class="console_text yellow">',
                render_strategy: 'iterator',
                items: $().dynatexer.helper.counter({
                    start: 1,
                    end: 100,
                    step: 1,
                    mask: '%d%'
                })
            }, {
                animation: 'additive',
                delay: 5,
                placeholder: '<span class="console_text blue">',
                render_strategy: 'text-one-shot',
                items: "\nConnection Established."
            }, {
                animation: 'additive',
                delay: 5,
                placeholder: '<span class="console_text blue">',
                render_strategy: 'text-one-shot',
                items: "\nResources are being checked.\n"
            }, {
                animation: 'replace',
                delay: 5,
                placeholder: '<span class="console_text yellow">',
                render_strategy: 'iterator',
                items: $().dynatexer.helper.counter({
                    start: 1,
                    end: 100,
                    step: 1,
                    mask: '%d%'
                })
            }, {
                animation: 'additive',
                delay: 10,
                placeholder: '<span class="console_text red">',
                render_strategy: 'text-one-shot',
                items: "\nUsername is not Verified."
            }, {
                animation: 'additive',
                delay: 10,
                placeholder: '<span class="console_text yellow">',
                render_strategy: 'text-one-shot',
                items: "\nVerification Required."
            }, ],
            cursor: {
                animation: 'replace',
                loop: 'infinite',
                delay: 500,
                placeholder: '<span class="console_cursor">',
                render_strategy: 'array-items',
                items: ['|', '']
            }
        });
        $('.generator-console').dynatexer('play', function() {
            console.log('complete');
            callback()
        })
    }

    function getRandomInt(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min
    }
    var livechat_name = '';
    var livechat_text_area = $('.livechatListArea');
    var livechat_text_list = $('.chatList');
    var livechat_text_area_height = livechat_text_area.height();
    var name_colors = ['#d4a112', '#987c2f', '#b02643', '#d72248', '#9d22d7', '#a65fc7', '#2771bc', '#1a82ed', '#28ba4a', '#136b28', '#9bc716'];
    var chat_names = ['Richard23', 'Philip', 'Rob001', 'Hill213', 'Prim', 'Grequod', 'Moseeld30', 'Allichere', 'Munplad60', 'Therainged', 'Perseent', 'Wasice59', 'Arrent', 'Quot1991', 'Yourlenis'];
    var chat_messages = ["Awesome,its rare to find working generator like this one", "Anyone tried this already?", "Does it work in NA?", "Why this is so easy lol?", "This is incredible, never thought it would work.", "I get Resource in a minute.", "shy i see survey ?", "its to protect from spamming, first try to use, i got no Survey request, but for second try i need to get Finish 1 Survey", "OMG!", "LOL!", "ROFL!", "Real", "gayyyy", "easy", "bro", "What can I do here?", "Shut up man I love this website", "hi guys", "How much resource you've generated so far?", "what about surveys on mobile phone?", "Is this free?", "How long do you have to wait?", "Yea", "No", "I know", "Exactly why this is so good", "uhm", "maybe", "I can imagine this must be annoying for the one who play with skill", "Is this ban secure?", "Thanks man I appreciate this.", "Cool =)", "<message deleted>", "oh god", "damn", "I love this", "Never imagined this would work but damn its so simple", "saw this on forums pretty impressive", "yo guys dont spam okay?", "anyone up for a game?", "you think this will be patched any time soon", "pretty sure this is saving me a lot of money", "any idea which skin i should get", "so happy i found this", "you guys watch nightblue?", "I have seen this generator on hotshot stream i think", "just wow", "When do I get my resource ??", "a friend told me about this", "thanks to whoever spams this website Finish my survey now", "how can finish this survey quickly?", "so far I am cool with this generaor", "can I get off this survey easily?", "bye guys, already finish my survey, and resources generated successfully", "okay i am stacked now with survey", "finished survey is easy, if you fill using valid data", "incredible", "three minutes ago cannot get fast resource, now i have and its works perfectly", "need to go now", "brb", "You should give it a try", "dont regret being here", "fucking generator is real", "first time ever this makes sense", "Does everyone have a different survey ", "got my resource in 5 minutes only :D", "what happen after finish a survey", "after finish a survey you'll get the resiurce ", "today is lucky day", "this is the best generator because we all have more than a chance", "i think everyone can do a survey quickly", "can we get more than one survey ?, first time success, and want to try for my sister account", "yes", "abselutely", "I got all resource for my girlfriend too"];
    setInterval(function() {
        add_livechat_msg(chat_names[getRandomInt(1, chat_names.length - 1)], name_colors[getRandomInt(1, name_colors.length - 1)], chat_messages[getRandomInt(1, chat_messages.length - 1)])
    }, getRandomInt(1500, 6000));
    $('.livechatSubmtBtn').click(function() {
        if (livechat_name == '') {
            $('.livechatNameBox').show()
        } else {
            add_livechat_msg(livechat_name, '#136b28', $('.livechatMsg').val());
            $('.livechatMsg').val('')
        }
    });
    $('.livechatNicknameBtn').click(function() {
        var name_input = $('#livechat_name');
        if (name_input.val() != '') {
            livechat_name = name_input.val();
            $(this).parents('.livechatNameBox').hide()
        } else {
            sweetAlert("Error", "Please enter a nickname.", "error")
        }
    });
    $(".livechatName").on("keypress", function() {
        console.log("Handler for .keypress() called.")
    });

    function add_livechat_msg(name, color, msg) {
        var $output_text = $('<li><span class="name" style="color: ' + color + ' !important;">' + name + '</span>: <span class="message">' + msg + '</span></li>');
        $output_text.hide().appendTo(livechat_text_list).fadeIn();
        livechat_text_area.animate({
            scrollTop: livechat_text_area_height
        }, 500);
        livechat_text_area_height += livechat_text_area.height()
    }
    $('.contact-btn').click(function() {
        if ($('#nameInput').val() != "") {
            if ($('#emailInput').val() != "") {
                if ($('#messageInput').val() != "") {
                    sweetAlert("Message Sent!", "Thank you for your feedback.", "success");
                    $('#nameInput, #emailInput, #messageInput').val('')
                } else {
                    sweetAlert("Error", "Please enter your message.", "error")
                }
            } else {
                sweetAlert("Error", "Please enter your email address.", "error")
            }
        } else {
            sweetAlert("Error", "Please enter your name.", "error")
        }
    })
});
$(window).resize(function() {});
