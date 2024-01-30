<script>
    $(document).ready(function(){
        function isExistFavorite(thread_id){
            var favorites=getFavoriteObject();
            if(favorites.hasOwnProperty("thread_"+thread_id)){
                updateMessageId();
                return true;
            }else {
                return false;
            }
        }
        function changeBtnFavoriteTitle(){
            if(isExistFavorite($(".btn-add-to-favorite").data("thread-id"))){
                $(".btn-add-to-favorite").html('Удалить из избранного');
            }else {
                $(".btn-add-to-favorite").html('Добавить в избранное');
            }
            $(".btn-add-to-favorite").show();
        }
        function updateMessageId(){
            var thread_id=$(".btn-add-to-favorite").data("thread-id");
            var last_message=$(".message_thread").last();
            var message_id=last_message.data("message-id");

            var favorites=getFavoriteObject();
            if(favorites.hasOwnProperty("thread_"+thread_id)){
                favorites["thread_"+thread_id]["message_id"]=message_id;
                saveFavoriteObject(favorites);
            }

        }
        function ToogletoFavorite(thread_id,board_alias,message_id,title){

            var favorites=getFavoriteObject();
            if(favorites.hasOwnProperty("thread_"+thread_id)){
                delete favorites["thread_"+thread_id];
            }else {
                favorites["thread_"+thread_id]={
                    "thread_id":thread_id,
                    "board_alias":board_alias,
                    "message_id":message_id,
                    "title":title,
                };
            }

            saveFavoriteObject(favorites);
        }
        function getFavoriteObject(){
            var favorites = window.localStorage.getItem("favorites");
            if(favorites){
                favorites=JSON.parse(favorites);
            }else {
                favorites={};
            }

            return favorites;

        }
        async function loadCount(thread_id,link){
            $.get( link, function( data ) {
                var count=data.count;
                $(".count_thread_"+thread_id).html(count);

            });
        }
        function loadFavorites(){
            var result_html="";
            var favorites=getFavoriteObject();
            var HtmlTemplate=$(".favorite_row")[0].innerHTML;
            if(Object.keys(favorites).length>0){
                Object.entries(favorites).forEach(([key, value]) => {
                    var link="/"+value.board_alias+"/"+value.thread_id;
                    var title=value.title;


                    var link_count='/ajax/'+value.board_alias+'/'+value.thread_id+'/'+value.message_id+'/count';
                    var count=0;
                    loadCount(value.thread_id,link_count);

                    var newHtml=HtmlTemplate.replace("[link]",link).replace("[title]",title+'<span class="badge bg-secondary count_thread_'+value.thread_id+'"></span>');
                    result_html+=newHtml;


                });

            }
            return result_html;
        }
        function saveFavoriteObject(object){
            var stringObject=JSON.stringify(object);
            window.localStorage.setItem("favorites",stringObject);
        }
        function autoUpdate(){
            if($(".message_thread").length>0){
                var last_message=$(".message_thread").last();
                var url=last_message.data("url");
                $.get( url, function( data ) {
                   if(data.results && data.results.length>0){
                       data.results.forEach((element) => {
                           $(".thread_div").append(element);
                       });
                       updateMessageId();
                   }
                });


            }



        }
        if($(".message_thread").length>0) {
            setInterval(autoUpdate, 15000);
        }
        if($(".btn-add-to-favorite").length>0){
            changeBtnFavoriteTitle();

            $(".btn-add-to-favorite").on("click",function(){
                var thread_id=$(this).data("thread-id");
                var board_alias=$(this).data("board-alias");
                var last_message=$(".message_thread").last();
                var message_id=last_message.data("message-id");
                var thread_title=$(".thread_name").text();
                ToogletoFavorite(thread_id,board_alias,message_id,thread_title);
                changeBtnFavoriteTitle();

            })
        }

        $(".btn-answer-form-show").on("click",function(){
            $(this).hide();
            $(".btn-answer-form-hide").show();
            $(".form_answer_div").show();
        });
        $(".btn-answer-form-hide").on("click",function(){
            $(this).hide();
            $(".btn-answer-form-show").show();
            $(".form_answer_div").hide();
        });
        $(".btn-favorite-reload").on("click",function(){
            $(".ajax_message_body_favorite").html("<p>Идет загрузка</p>");
            var result_html=loadFavorites();
            $(".ajax_message_body_favorite").html(result_html);
        });
        $(".btn_favorite_modal").on("click",function(){


            var result_html=loadFavorites();

            var myModal = new bootstrap.Modal(document.getElementById('modalFavorite'));
            $(".ajax_message_body_favorite").html(result_html);
            myModal.show();
        });
        $("body").on("click",".btn_load_answers",function(){
            var link=$(this).data("link");
            var id=$(this).data("id");
            var modal_html=$("#modalDynamic").html();
            console.log(modal_html);
            var id_modal="answers"+id;
            modal_html=modal_html.replaceAll("[idModal]",id_modal);
            $("body").append(modal_html);

            var myModal = new bootstrap.Modal(document.getElementById(id_modal));



            $.get( link, function( data ) {
                $(".ajax_message_title").text("Ответы");
                $( ".ajax_message_body_"+id_modal ).html( data );
                myModal.show();
            });
            return false;
        });
    })

</script>
