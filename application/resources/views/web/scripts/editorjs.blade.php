<script src="{{ asset('js/editorjs/delimiter.js') }}"></script>
<script src="{{ asset('js/editorjs/list.js') }}"></script>
<script src="{{ asset('js/editorjs/checklist.js') }}"></script>
<script src="{{ asset('js/editorjs/quote.js') }}"></script>
<script src="{{ asset('js/editorjs/code.js') }}"></script>
<script src="{{ asset('js/editorjs/table.js') }}"></script>
<script src="{{ asset('js/editorjs/warning.js') }}"></script>
<script src="{{ asset('js/editorjs/attaches.js') }}"></script>
<script src="{{ asset('js/editorjs/marker.js') }}"></script>
<script src="{{ asset('js/editorjs/inline-code.js') }}"></script>
<script src="{{ asset('js/editorjs/editorjs-paragraph-special.js') }}"></script>
<script src="{{ asset('js/editorjs/editorjs-button.js') }}"></script>
<script src="{{ asset('js/editorjs/ImageBundle.js') }}"></script>
<script src="{{ asset('js/editorjs/carousel_editor.js') }}"></script>
<script  src="{{ asset('js/editorjs/TelegramEmbed.js') }}"></script>
<script src="{{ asset('js/editorjs/RutubeEmbed.js') }}"></script>
<script src="{{ asset('js/editorjs/VkVideoEmbed.js') }}"></script>
<script src="{{ asset('js/editorjs/VkClipsEmbed.js') }}"></script>
<script src="{{ asset('js/editorjs/LinkTool.js') }}"></script>
<script src="{{ asset('js/editorjs/Embedbundle.js') }}"></script>
<script src="{{ asset('js/editorjs/FigmaEmbed.js') }}"></script>
<script src="{{ asset('js/editorjs/Vote.js') }}"></script>
<script src="{{ asset("js/editorjs/MapsPlugin.js") }}"></script>
<script src="{{ asset("js/editorjs/editorjs-columns.js") }}"></script>
<script src="{{ asset("js/editorjs/editorjs-header-with-alignment.js") }}"></script>
<script src="{{ asset('js/editorjs/editorjs.js') }}"></script>
<script src="{{ asset("js/editorjs/editorjs-paragraph-with-alignment.js") }}"></script>
<script>


    $(document).ready(function(){
        function reloadCaptcha(){
            $("[name='captcha']").val("");
            var url="{{ route("ajax.captcha") }}";

            $.get( url, function( data ) {
                $(".image_captcha").html(" ");
                $(".image_captcha").html(data['img']);
            });
        }

        $(".regenarate_captcha").on("click",function(){
            reloadCaptcha();
        })

        $(".ajax_form").on("submit",function(){
            var form = document.querySelector('.ajax_form');
            $(".form-answer-error").hide();
            $(".form-answer-error").html(" ");

            var data_form=new FormData(form);
            $.ajax({
                url: $(this).attr("action"), // url where to submit the request
                type : "POST", // type of action POST || GET

                data : data_form, // post data || get data
                contentType: false,
                processData: false,
                success : function(result) {
                    // you can see the result from the console
                    // tab of the developer tools
                    if(result.success){
                        if(result.url){
                            document.location.href=result.url;
                        }else {
                            var url                = window.location.href;
                            url                    = url.replace("#botton", "");
                            document.location.hash="";
                            url                    = url + "#botton";
                            document.location.href = url;
                            document.location.reload();
                        }
                    }
                },
                error: function(xhr, resp, text) {
                    reloadCaptcha();

                    var html="";



                    for (var key in xhr.responseJSON.errors) {
                        var error_field=key;

                        xhr.responseJSON.errors[key].forEach((element) => {
                            html=html+"<p><strong>("+error_field+")</strong>-"+element+"</p>";
                        })

                    }


                    $(".form-answer-error").show();
                    $(".form-answer-error").html(html);
                    // console.log(xhr, resp, text);
                }
            })
           return false;
        });

        $("body").on("click",".btn-quote-action",function(){
            try{
                var link=$(this).data("link");
                var name=$(this).data("name");
                const blockToAdd = {
                    type: 'linkTool',
                    data: {
                        "link":link,
                        "meta":{
                            "title":name
                        }

                    }
                };
                editor.blocks.insert("linkTool", blockToAdd.data);
            }catch(err){

            }



            return false;
        })





        var in_js_user_data={"blocks":[
                {
                    "id":"feFcOi5sm8",
                    "type":"header",
                    "data":{
                        "text":"",

                    }
                },
                {
                    "id":"feFcOi5sm7",
                    "type":"paragraph",
                    "data":{
                        "text":"",

                    }
                }
            ]};


        var image_lang_tool_name="Фото или Видео";
        var image_lang_tool_arr={
            "title":"Фото или видео",
            'Couldn’t upload image. Please try another.':'Произошла ошибка при загрузке изображения или видео.',
        };
        var image_config={

            types:"image/*,video/mp4,video/avi",
            'captionPlaceholder':"Введите заголовок",
            'buttonContent':'Выберите изображение или видео(mp4,avi)( до 50 MB)',
            endpoints: {
                byFile: "{{ route('site.editorjs.upload.image_video',$board->getAlias()) }}", // Your backend file uploader endpoint

            }

        };



        var editorJsTools={
            /**
             * Each Tool is a Plugin. Pass them via 'class' option with necessary settings {@link docs/tools.md}
             */
            paragraph: {
                class: Paragraph,
                // class:paragraph,

                inlineToolbar: true,
                config:{
                    placeholder:"Нажмите Tab или кнопку + для выбора инструмента",
                }
            },
            header: {
                class: Header,
                inlineToolbar: ['link'],
                config: {
                    placeholder: 'Заголовок'
                },
                shortcut: 'CMD+SHIFT+H'
            },
            embed: Embed,
            linkTool: {
                class : LinkTool,
                config: {
                    endpoint: '{{ route('site.editorjs.parse_url',$board->getAlias()) }}',
                }
            },
            image: {
                class: window.ImageTool,
                inlineToolbar: true,
                config: image_config
            },

            {{--image: {--}}
            {{--    class: window.ImageTool,--}}
            {{--    inlineToolbar: true,--}}
            {{--    config: image_config--}}
            {{--},--}}
            {{--vote:{--}}
            {{--    class:window.Vote,--}}
            {{--    config:{--}}
            {{--        url:{--}}
            {{--            create_vote:"{{ route('site.index') }}",--}}
            {{--            get_vote:"{{ route('site.index',"id") }}",--}}
            {{--        }--}}
            {{--    }--}}
            {{--},--}}
            {{--maps:{--}}
            {{--    class:window.Maps,--}}
            {{--    config:{--}}
            {{--        url:"{{ route('site.index') }}",--}}
            {{--    }--}}
            {{--},--}}
            {{--/**--}}
            {{-- * Or pass class directly without any configuration--}}
            {{-- */--}}
            {{--carousel: {--}}
            {{--    class: Carousel,--}}
            {{--    inlineToolbar: true,--}}
            {{--    config: {--}}
            {{--        endpoints: {--}}
            {{--            byFile: "{{ route('site.index') }}",--}}
            {{--            // removeImage: "URL_FETCH", //default null--}}
            {{--        },--}}
            {{--        additionalRequestHeaders: {--}}
            {{--            // 'authorization': 'Bearer eyJhbGciJ9...TJVA95OrM7h7HgQ',--}}
            {{--            // ...--}}
            {{--        },--}}
            {{--        field: 'image',--}}
            {{--        types: 'image/*',--}}
            {{--        // additionalRequestData: { // for custom data--}}
            {{--        //     name: 'your custom data name',--}}
            {{--        //     order_data: 'your order custom data',--}}
            {{--        // },--}}
            {{--        // galleryCallback: 'your_prefer_callback_data' // object return is required--}}
            {{--    }--}}
            {{--},--}}
            {{--AnyButton: {--}}
            {{--    class: AnyButton,--}}
            {{--    inlineToolbar: false,--}}
            {{--    config:{--}}
            {{--        css:{--}}
            {{--            "btnColor": "btn--gray",--}}
            {{--        }--}}
            {{--    }--}}
            {{--},--}}
            {{--attaches: {--}}
            {{--    class: AttachesTool,--}}
            {{--    config: {--}}
            {{--        buttonText:"Загрузить файл(до 50МБ)",--}}
            {{--        errorMessage:"При загрузке файла произошла ошибка. Максимальный размер файла 50мб",--}}
            {{--        endpoint: '{{ route('site.index') }}',--}}
            {{--    }--}}
            {{--},--}}
            {{--list: {--}}
            {{--    class: List,--}}
            {{--    inlineToolbar: true,--}}
            {{--    shortcut: 'CMD+SHIFT+L'--}}
            {{--},--}}

            {{--checklist: {--}}
            {{--    class: Checklist,--}}
            {{--    inlineToolbar: true,--}}
            {{--},--}}

            {{--quote: {--}}
            {{--    class: Quote,--}}
            {{--    inlineToolbar: true,--}}
            {{--    config: {--}}
            {{--        quotePlaceholder: 'Enter a quote',--}}
            {{--        captionPlaceholder: 'Quote\'s author',--}}
            {{--    },--}}
            {{--    shortcut: 'CMD+SHIFT+O'--}}
            {{--},--}}

            {{--warning: Warning,--}}

            {{--marker: {--}}
            {{--    class:  Marker,--}}
            {{--    shortcut: 'CMD+SHIFT+M'--}}
            {{--},--}}



            {{--delimiter: Delimiter,--}}

            {{--inlineCode: {--}}
            {{--    class: InlineCode,--}}
            {{--    shortcut: 'CMD+SHIFT+C'--}}
            {{--},--}}
            {{--figma:FigmaEmbed,--}}
            {{--rutubeembed:RutubeEmbed,--}}
            {{--vkvideoembed:VkVideoEmbed,--}}
            {{--vkclipsembed:VkClipsEmbed,--}}
            {{--telegramembed:TelegramEmbed,--}}


            {{--embed: Embed,--}}

            {{--table: {--}}
            {{--    class: Table,--}}
            {{--    inlineToolbar: true,--}}
            {{--    shortcut: 'CMD+ALT+T'--}}
            {{--},--}}
            {{--linkTool: {--}}
            {{--    class: LinkTool,--}}
            {{--    config:{--}}
            {{--        endpoint:'{{ route('site.index') }}',--}}
            {{--    }--}}


            {{--},--}}
        };


        var editor = new EditorJS({
            /**
             * Wrapper of Editor
             */
            holderId: 'editorjs',
            i18n: {
                /**
                 * @type {I18nDictionary}
                 */
                messages: {
                    /**
                     * Other below: translation of different UI components of the editor.js core
                     */
                    ui: {
                        "blockTunes": {
                            "toggler": {
                                "Click to tune": "Нажмите, чтобы настроить",
                                "or drag to move": "или перетащите"
                            },
                        },
                        "inlineToolbar": {
                            "converter": {
                                "Convert to": "Конвертировать в"
                            }
                        },
                        "toolbar": {
                            "toolbox": {
                                "Add": "Добавить"
                            }
                        }
                    },

                    /**
                     * Section for translation Tool Names: both block and inline tools
                     */
                    toolNames: {
                        "Columns":"Колонки",
                        "Carousel":"Галлерея",
                        "Button":"Кнопка",
                        "Text": "Параграф",
                        "Heading": "Заголовок",
                        "List": "Список",
                        "Warning": "Примечание",
                        "Checklist": "Чеклист",
                        "Quote": "Цитата",
                        "Code": "Код",
                        "Delimiter": "Разделитель",
                        "Raw HTML": "HTML-фрагмент",
                        "Table": "Таблица",
                        "Link": "Ссылка",
                        "Marker": "Маркер",
                        "Bold": "Полужирный",
                        "Italic": "Курсив",
                        "InlineCode": "Моноширинный",
                        'Image':image_lang_tool_name,
                        'Attachment':'Файл',
                    },

                    /**
                     * Section for passing translations to the external tools classes
                     */
                    tools: {
                        /**
                         * Each subsection is the i18n dictionary that will be passed to the corresponded plugin
                         * The name of a plugin should be equal the name you specify in the 'tool' section for that plugin
                         */
                        "AnyButton": {
                            'Button Text': 'текст отображения на кнопке',
                            'Link Url': 'Ссылка',
                            'Set': "Создать кнопку",
                            'Default Button': "По умолчанию",
                        },
                        "header":{
                            "title":"Заголовок",
                        },


                        "image":image_lang_tool_arr,
                        "warning": { // <-- 'Warning' tool will accept this dictionary section
                            "Title": "Название",
                            "Message": "Сообщение",
                        },

                        /**
                         * Link is the internal Inline Tool
                         */
                        "link": {
                            "Add a link": "Вставьте ссылку"
                        },
                        /**
                         * The "stub" is an internal block tool, used to fit blocks that does not have the corresponded plugin
                         */
                        "stub": {
                            'The block can not be displayed correctly.': 'Блок не может быть отображен'
                        }
                    },

                    /**
                     * Section allows to translate Block Tunes
                     */
                    blockTunes: {
                        /**
                         * Each subsection is the i18n dictionary that will be passed to the corresponded Block Tune plugin
                         * The name of a plugin should be equal the name you specify in the 'tunes' section for that plugin
                         *
                         * Also, there are few internal block tunes: "delete", "moveUp" and "moveDown"
                         */
                        "delete": {
                            "Delete": "Удалить"
                        },
                        "moveUp": {
                            "Move up": "Переместить вверх"
                        },
                        "moveDown": {
                            "Move down": "Переместить вниз"
                        }
                    },
                }
            },
            /**
             * Tools list
             */
            tools: editorJsTools,

            /**
             * This Tool will be used as default
             */
            // initialBlock: 'paragraph',

            /**
             * Initial Editor data
             */
            data: {
                blocks:[],
            },
            onReady: function(){
                editor.render( in_js_user_data);
                // saveButton.click();
            },
            onChange: function() {
                $(".btn_form").hide();
                editor.save().then( savedData => {
                    var formData = JSON.stringify(savedData);
                    $(".editor_js_content").val(formData)
                    $(".btn_form").show();

                })
                console.log('something changed');
            }
        });
    })
</script>
