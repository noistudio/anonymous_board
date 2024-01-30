
class Vote {
    static get toolbox() {
        return {
            title: 'Опрос',
            icon: '\n' +
                '<?xml version="1.0" ?><!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->\n' +
                '<svg width="800px" height="800px" viewBox="0 0 50 50" data-name="Layer 1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"><defs><style>.cls-1{fill:#231f20;}.cls-2{fill:#ffffff;}.cls-3{fill:#00a1d3;}.cls-4{fill:#f7d2d0;}.cls-5{fill:#c6b9c4;}.cls-6{fill:#ff8e5a;}</style></defs><title/><path class="cls-1" d="M45.5,18.207a.5.5,0,0,0-.146-.353L42.2,14.7a.5.5,0,0,0-.707,0L33.22,22.969V7a2.5,2.5,0,0,0-2.5-2.5H7A2.5,2.5,0,0,0,4.5,7V43A2.5,2.5,0,0,0,7,45.5H30.72a2.5,2.5,0,0,0,2.5-2.5V30.694L45.354,18.561A.5.5,0,0,0,45.5,18.207Z"/><path class="cls-2" d="M27.008,29.182a.5.5,0,0,0-.1.152l-2.2,5.011a.758.758,0,0,0,.109.9.717.717,0,0,0,.511.208.773.773,0,0,0,.358-.088l3.687-1.62v7.936H8.073V8.321h4.241a3.178,3.178,0,0,0,2.7,1.517H22.7a3.178,3.178,0,0,0,2.7-1.517h3.96v18.5Z"/><path class="cls-3" d="M32.22,43a1.5,1.5,0,0,1-1.5,1.5H7A1.5,1.5,0,0,1,5.5,43V7A1.5,1.5,0,0,1,7,5.5h4.829V6.65a3.15,3.15,0,0,0,.074.671H7.573a.5.5,0,0,0-.5.5V42.179a.5.5,0,0,0,.5.5H29.866a.5.5,0,0,0,.5-.5V33.3l.352-.155a.5.5,0,0,0,.153-.1l1.349-1.35Z"/><path class="cls-1" d="M18.525,15.813H27.7a.5.5,0,0,0,0-1H18.525a.5.5,0,0,0,0,1Z"/><path class="cls-1" d="M14.083,14.131,12.934,15.28l-.443-.443a.5.5,0,1,0-.707.707l.8.8a.5.5,0,0,0,.707,0l1.5-1.5a.5.5,0,0,0-.707-.707Z"/><path class="cls-1" d="M13.1,11.735a3.577,3.577,0,1,0,3.576,3.578A3.582,3.582,0,0,0,13.1,11.735Zm0,6.154a2.577,2.577,0,1,1,2.576-2.576A2.58,2.58,0,0,1,13.1,17.889Z"/><path class="cls-1" d="M27.7,24.5H18.525a.5.5,0,0,0,0,1H27.7a.5.5,0,0,0,0-1Z"/><path class="cls-1" d="M14.083,23.818l-1.149,1.15-.443-.444a.5.5,0,1,0-.707.707l.8.8a.5.5,0,0,0,.707,0l1.5-1.5a.5.5,0,0,0-.707-.707Z"/><path class="cls-1" d="M13.1,21.424A3.576,3.576,0,1,0,16.675,25,3.581,3.581,0,0,0,13.1,21.424Zm0,6.152A2.576,2.576,0,1,1,15.675,25,2.579,2.579,0,0,1,13.1,27.576Z"/><path class="cls-1" d="M22.452,34.188H18.525a.5.5,0,0,0,0,1h3.927a.5.5,0,0,0,0-1Z"/><path class="cls-1" d="M14.083,33.507l-1.149,1.148-.443-.442a.5.5,0,1,0-.707.707l.8.8a.5.5,0,0,0,.707,0l1.5-1.5a.5.5,0,0,0-.707-.707Z"/><path class="cls-1" d="M13.1,31.111a3.577,3.577,0,1,0,3.576,3.577A3.582,3.582,0,0,0,13.1,31.111Zm0,6.154a2.577,2.577,0,1,1,2.576-2.577A2.581,2.581,0,0,1,13.1,37.265Z"/><path class="cls-3" d="M32.22,7V23.968h0l-1.854,1.854v-18a.5.5,0,0,0-.5-.5H25.818a3.215,3.215,0,0,0,.074-.671V5.5H30.72A1.5,1.5,0,0,1,32.22,7Z"/><polygon class="cls-4" points="28.053 33.228 26.824 31.998 27.604 30.224 29.827 32.448 28.053 33.228"/><polygon class="cls-3" points="26.393 32.98 27.071 33.66 25.86 34.192 26.393 32.98"/><path class="cls-5" d="M24.892,6.65A2.191,2.191,0,0,1,22.7,8.838H15.016A2.19,2.19,0,0,1,12.829,6.65V5.5H24.892Z"/><rect class="cls-6" height="3.463" transform="translate(-6.217 32.602) rotate(-45)" width="19.298" x="26.597" y="22.074"/></svg>'
        };
    }
    constructor({data, api, config}){
        this.api = api;
        this.title_block=null;
        this.name_ticket_label=null;
        this.name_ticket=null;
        this.exist_vote=null;
        this.can_delete=null;
        this.questions={};
        this.btn_add_question=null;
        this.btn_save_vote=null;
        this.to=null;
        this.addr_list=null;
        this.editor_data=data;
        this.data = data;
        this.config = config || {};
        this.wrapper = undefined;
        this.el_questions_list=undefined;
    }

    delete_question(id_question){

        var app=this;
        //alert('id_question is '+id_question);
        var question_selector="question_div_"+id_question;
        document.querySelectorAll("."+question_selector).forEach(el => el.remove());
        if(app.data.questions && app.data.questions.length>0){
            var current_index=null;
            app.data.questions.forEach(function(elem,index){
                if(elem.id_question==id_question){
                    current_index=index;
                }
            });
            if(current_index!=null){
                app.data.questions.splice(current_index,1);
                app.questions=app.questions.filter(val => val);
                // console.log('success delete question('+id_question+') with index  '+current_index);
            }


        }


    }
    delete_answer(key_question,key_answer){
        var app=this;

        // const elements = document.getElementsByClassName("answer_div_"+key_question+"_"+key_answer);
        document.querySelectorAll(".answer_div_"+key_question+"_"+key_answer).forEach(el => el.remove());



        if(app.data.questions[key_question] && app.data.questions[key_question]['answers']
            && app.data.questions[key_question]['answers'][key_answer]){
            app.data.questions[key_question].answers.splice(key_answer,1);
            // app.questions[key_question].answers=app.questions[key_question].answers.filter(val => val)
            // console.log('success removed',[key_question,key_answer]);

        }


    }
    get_vote(id){
        var app=this;
        return new Promise((res,rej)=>{
            app.wrapper.classList.add('cdx-loader');
            var url=app.config.url.get_vote;
            url=url.replace("id",id);
            let xhr = new XMLHttpRequest();
            xhr.open("GET", url);
            xhr.setRequestHeader("Accept", "application/json");
            xhr.setRequestHeader("Content-Type", "application/json");

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {

                    var json_answer=JSON.parse(xhr.responseText);

                    if(json_answer.type && json_answer.type=="success") {


                        app.wrapper.classList.remove('cdx-loader');
                        res(json_answer);

                    }else {
                        app.wrapper.classList.remove('cdx-loader');
                        // app.btn_save_vote.innerText=json_answer.message;
                        rej(json_answer.message);
                    }
                    //return myResolve(result);


                }};



            xhr.send();

        })
    }
    save_vote(){
        var app=this;
        return new Promise((res,rej)=>{
            app.wrapper.classList.add('cdx-loader');
            let xhr = new XMLHttpRequest();
            xhr.open("POST", app.config.url.create_vote);
            xhr.setRequestHeader("Accept", "application/json");
            xhr.setRequestHeader("Content-Type", "application/json");

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {

                    var json_answer=JSON.parse(xhr.responseText);

                    if(json_answer.type && json_answer.type=="success") {
                        //  result.to=json_answer.to;
                        //result.from=json_answer.from;

                        var data={};
                        data.vote_id=json_answer.vote_id
                        app.data=Object.assign(app.data,data);
                        //app.data={"vote_id":json_answer.vote_id};
                        app.wrapper.classList.remove('cdx-loader');

                        res(json_answer.vote_id);
                        //app.data=result;
                        // button.innerText="Координаты загружены!";
                    }else {
                        app.wrapper.classList.remove('cdx-loader');
                        // app.btn_save_vote.innerText=json_answer.message;
                        rej(json_answer.message);
                    }
                    //return myResolve(result);


                }};



            xhr.send(JSON.stringify(app.data));

        })
    }
    add_answer(id_question,value_answer="Новый вариант",parent_obj){
        var app=this;
        //  var key_question=null;

        // console.log('la la la',app.data.questions);
        // if(app.data.questions && app.data.questions.length>0){
        //     console.log('before check!');
        //
        // }







        if(!(app.data.questions[id_question])){

            app.data.questions[id_question]={};

        }
        if(!(app.data.questions[id_question].variants)){
            app.data.questions[id_question].variants=[];
        }
        var  current_number_answer=app.data.questions[id_question].variants.length;
        app.data.questions[id_question].variants.push({"name":"Новый вариант"});

        var question_div=app.questions[id_question];



        var div=document.createElement("div");
        div.classList.add("cdx-block");
        div.classList.add("answer_div");









        var input_answer=document.createElement("input");
        input_answer.classList.add("cdx-input");
        input_answer.classList.add("text_answer");
        input_answer.setAttribute("placeholder","Введите ответ");
        input_answer.value="";
        input_answer.addEventListener("change", (event) => {
            app.data.questions[id_question]['variants'][current_number_answer]=event.target.value;




        });

        div.appendChild(input_answer);


        parent_obj.appendChild(div);


        return parent_obj;



    }
    add_question(value=null,id_question=null){


        var app=this;


        var next_number_question=0;
        if(!(app.data && app.data.questions)){
            app.data.questions=[];
        }

        var current_id=app.data.questions.length;
        app.data.questions.push({
            "name":"Новый вопрос",
            "multiple":0,
            "variants":[],
        });

        value="Новый вопрос";
        var new_div=document.createElement("div");
        new_div.classList.add("cdx-block");
        new_div.classList.add("question_div");
        new_div.classList.add("question_div_"+id_question);
        var new_question_label=document.createElement("p");
        new_question_label.innerHTML="Введите текст вопроса";
        var new_question=document.createElement("input");



        new_question.classList.add('cdx-input');
        new_question.classList.add('question_input');
        new_question.setAttribute("placeholder","Введите вопрос");
        new_question.addEventListener("change", (event) => {


            if(!(app.data.questions[current_id])){
                app.data['questions'][current_id]={};
            }
            app.data['questions'][current_id]['name']=event.target.value;






        });
        new_div.appendChild(new_question_label);
        new_div.appendChild(new_question);

        var multiple=document.createElement("select");
        multiple.classList.add("cdx-input");
        multiple.classList.add("type_answer");
        var option_notcorrect=document.createElement("option");
        option_notcorrect.setAttribute("value","0");
        option_notcorrect.innerText="Один вариант";
        var option_correct=document.createElement("option");
        option_correct.setAttribute("value","1");
        option_correct.innerText="Несколько вариантов";


        multiple.appendChild(option_notcorrect);
        multiple.appendChild(option_correct);

        multiple.addEventListener("click", (event) => {

            app.data['questions'][current_id]["multiple"]=event.target.value;









        });
        var answers_label=document.createElement("p");
        answers_label.innerHTML="Варианты";
        var div_answers=document.createElement("div");
        div_answers.classList.add("answers");
        div_answers.classList.add("answers_"+id_question);

        new_div.appendChild(multiple);
        new_div.appendChild(answers_label);
        new_div.appendChild(div_answers);
        var new_answer_btn=document.createElement("button");
        new_answer_btn.classList.add("cdx-button");
        new_answer_btn.classList.add("button-add-answer");
        new_answer_btn.innerHTML="Добавить вариант";
        new_answer_btn.onclick=function(){

            new_div=app.add_answer(current_id,"0",new_div);

            return false;
        };


        new_div.appendChild(new_answer_btn);
        var hr=document.createElement("hr");
        new_div.appendChild(hr);

        var delete_button=document.createElement("button");
        delete_button.innerHTML="Удалить вопрос";
        delete_button.classList.add("cdx-button");
        delete_button.classList.add("delete_question");





        //app.questions[id_question]=new_div;
        app.el_questions_list.appendChild(new_div);




    }
    // show_all_addrs(){
    //
    //     var app=this;
    //     var element_addr=this.addr_list;
    //     element_addr.innerHTML="";
    //     if(app.data.addrs && app.data.addrs.length>0){
    //         app.data.addrs.forEach(function(elem,index){
    //             var delete_btn=document.createElement("button");
    //             delete_btn.innerText="[Удалить]";
    //             delete_btn.onclick = function(){
    //                 delete app.data.addrs[index];
    //                 app.show_all_addrs();
    //             };
    //             var li = document.createElement('li');
    //             li.innerText = elem.title;
    //             li.appendChild(delete_btn);
    //             element_addr.appendChild(li);
    //         });
    //     }
    //
    //     ///  element_addr.innerText=addr.title;
    //
    //     //  app.wrapper.appendChild(element_addr);
    // }
    render_exist(){
        var app=this;
        var current_data=app.data;
        // console.log('current_data is',current_data);


        app.wrapper=document.createElement("div");
        app.exist_vote=document.createElement("p");
        app.exist_vote.innerHTML="Голосование под ID "+app.data['vote_id'];
        app.wrapper.classList.add("cdx-block");
        app.wrapper.classList.add("questions_list");
        app.wrapper.classList.add("ticket_quiz_block");

        app.wrapper.appendChild(app.exist_vote);

        return app.wrapper;

    }

    render(){


        var app=this;

        if(!app.data.can_delete){
            app.data.can_delete="0";
        }
        app.wrapper=document.createElement("div");

        app.wrapper.classList.add("cdx-block");
        app.title_block=document.createElement("p");
        app.title_block.classList.add("ticket_title_block");


        app.can_delete=document.createElement("select");
        app.can_delete.classList.add("cdx-input");
        app.can_delete.classList.add("type_answer");
        var option_notcorrect=document.createElement("option");
        option_notcorrect.setAttribute("value","0");
        option_notcorrect.innerText="Нельзя переголосовать";
        var option_correct=document.createElement("option");
        option_correct.setAttribute("value","1");
        option_correct.innerText="Можно переголосовать";


        app.can_delete.appendChild(option_notcorrect);
        app.can_delete.appendChild(option_correct);


        app.title_block.innerHTML=Vote.toolbox.title;

        app.name_ticket_label=document.createElement("p");
        app.name_ticket_label.innerHTML="Введите название опроса";

        app.name_ticket=document.createElement('input');
        app.name_ticket.classList.add("input_name_ticket");
        app.name_ticket.placeholder="Введите название опроса";
        app.name_ticket.classList.add("cdx-input");
        app.name_ticket.value="";
        app.data['name']="Название опроса";



        app.btn_add_question=document.createElement("button");
        app.btn_add_question.classList.add("cdx-button");
        app.btn_add_question.innerHTML="Добавить вопрос";
        app.btn_add_question.classList.add("button-add-question");



        app.btn_save_vote=document.createElement("button");
        app.btn_save_vote.classList.add("cdx-button");

        app.btn_save_vote.innerHTML="Создать голосование";
        app.btn_save_vote.classList.add("button_create_vote");;



        if((app.data && app.data['vote_id'])){



        }else {
            app.wrapper.innerHTML='';
            app.wrapper.classList.add("questions_list");
            app.wrapper.classList.add("ticket_quiz_block");
            app.wrapper.appendChild(app.title_block);
            // app.wrapper.appendChild(app.name_ticket_label);
            app.wrapper.appendChild(app.name_ticket);
            app.wrapper.appendChild(app.can_delete);
            app.wrapper.appendChild(app.btn_add_question);

        }


        app.btn_add_question.onclick=function(){
            app.add_question("Новый вопрос",app.randomString(10));
            return false;
        };
        app.btn_save_vote.addEventListener('click',(event)=>{
            {
                app.wrapper.classList.add('cdx-loader');

                app.save_vote().then(function(vote_id){
                    app.data={"vote_id":vote_id};
                    app.wrapper.classList.remove('cdx-loader');

                    return app.show_vote(vote_id);
                },function(err_message){
                    app.btn_save_vote.innerHTML=err_message;
                    app.wrapper.classList.remove('cdx-loader');
                })










            };
        });
        app.name_ticket.addEventListener("change", (event) => {
            app.data["name"]=event.target.value;
        });
        app.can_delete.addEventListener("click", (event) => {

            app.data['can_delete']=event.target.value;








        });
        if((app.data && app.data['vote_id'])){

            return app.show_vote(app.data['vote_id']);

        }else {
            var el_vote_footer=document.createElement("div");
            el_vote_footer.classList.add("vote_footer");
            el_vote_footer.appendChild(app.btn_save_vote);
            var el_questions_list=document.createElement("div");
            el_questions_list.classList.add("foter_questions");
            app.el_questions_list=el_questions_list;
            app.wrapper.appendChild(app.el_questions_list);
            app.wrapper.appendChild(el_vote_footer);
            return this.wrapper;
        }


    }

    show_vote(vote_id){

        var app=this;
        app.get_vote(vote_id).then(function(result){
            /// console.log('result is',result);

            app.wrapper.innerHTML='';
            app.exist_vote=document.createElement("p");
            app.exist_vote.innerHTML="Голосование: "+result.vote.name;


            app.wrapper.classList.add("cdx-block");
            app.wrapper.classList.add("questions_list");
            app.wrapper.classList.add("ticket_quiz_block");

            app.wrapper.appendChild(app.exist_vote);
            var can_delete= document.createElement("p");
            if(result.vote.can_delete==1){
                can_delete.innerHTML="Голосовать можно несколько раз";
            }else {
                can_delete.innerHTML="Нельзя переголосовывать";
            }

            app.wrapper.appendChild(can_delete);


            result.vote.questions.forEach(function(question){
                var question_div=document.createElement("div");
                question_div.classList.add("question_div");
                var new_p=app.exist_vote=document.createElement("p");
                new_p.innerHTML="<b>Вопрос</b>:"+question.name;
                question_div.appendChild(new_p);

                var multiple= document.createElement("p");
                if(question.multiple==1){
                    multiple.innerHTML="Можно отмечать несколько вариантов";
                }else {
                    multiple.innerHTML="Только один вариант";
                }
                question_div.appendChild(multiple);
                question.variants.forEach(function(variant){
                    var new_variant=app.exist_vote=document.createElement("p");
                    var total=0;
                    if(question.total>0){
                        var total=Math.floor((variant.total * 100 )/ question.total)
                    }

                    new_variant.innerHTML="<b>Ответ</b>:"+ variant["name"]+ '<small class="text-muted ml-4" v-if="question.total==0">'+total+'%</small><span class="pull-right">'+variant.total+'</span>';
                    question_div.appendChild(new_variant);
                })
                app.wrapper.appendChild(question_div);
            });

        },function(err){

        })

        return app.wrapper;

    }
    randomString(len, charSet) {
        charSet = charSet || 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var randomString = '';
        for (var i = 0; i < len; i++) {
            var randomPoz = Math.floor(Math.random() * charSet.length);
            randomString += charSet.substring(randomPoz,randomPoz+1);
        }
        return randomString;
    }

    save(blockContent){

        var app=this;

        var result=this.data;

        var return_data={};

        return_data.vote_id=result.vote_id;







        return return_data;







    }
    validate(savedData){

        if(!(savedData.vote_id)){
            return false;
        }

        return true;

        // }catch(e){
        //     return false;
        // }






    }
}



window.Vote=Vote;
