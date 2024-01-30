class MapsPlugin {
    static get toolbox() {
        return {
            title: 'Карта v2',
            icon: 'M'
        };
    }
    constructor({data, api, config}){
        this.api = api;

        this.from=null;
        this.to=null;
        this.addr_list=null;
        this.data = data;
        this.config = config || {};
        this.wrapper = undefined;
    }
    show_all_addrs(){

        var app=this;
        var element_addr=this.addr_list;
        element_addr.innerHTML="";
        if(app.data.addrs && app.data.addrs.length>0){
            app.data.addrs.forEach(function(elem,index){
                var delete_btn=document.createElement("button");
                delete_btn.innerText="[Удалить]";
                delete_btn.onclick = function(){
                    delete app.data.addrs[index];
                    app.show_all_addrs();
                };
                var li = document.createElement('li');
                li.innerText = elem.title;
                li.appendChild(delete_btn);
                element_addr.appendChild(li);
            });
        }

        ///  element_addr.innerText=addr.title;

        //  app.wrapper.appendChild(element_addr);
    }

    render(){
        var app=this;
        app.wrapper=document.createElement("div");
        app.wrapper.classList.add("cdx-block");


        console.log('current data is');
        console.log(app.data);

        this.addr_list=document.createElement('ol');
        this.from=document.createElement('input');
        this.from.classList.add('cdx-input');
        this.from.classList.add('from');
        this.from.placeholder="Введите адрес";
        this.from.value = this.data && this.data.from_title ? this.data.from_title : '';


        var button=document.createElement("button");
        button.classList.add("cdx-button");
        button.innerText="Загрузить координаты";

        button.onclick = function(){

            app.wrapper.classList.add('cdx-loader');
            var result={

            };
            const from_title = app.from.value;

            result.addr=from_title;

            let xhr = new XMLHttpRequest();
            xhr.open("POST", app.config.url);
            xhr.setRequestHeader("Accept", "application/json");
            xhr.setRequestHeader("Content-Type", "application/json");

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {

                    var json_answer=JSON.parse(xhr.responseText);

                    if(json_answer.addr) {
                        //  result.to=json_answer.to;
                        //result.from=json_answer.from;
                        if(!(app.data.addrs)){
                            app.data.addrs=[];
                        }
                        app.data.addrs.push(json_answer.addr);
                        app.show_all_addrs();
                        app.from.value="";
                        //app.data=result;
                        // button.innerText="Координаты загружены!";
                    }else {
                        button.innerText="Ошибка:Адрес не распознан";
                    }
                    //return myResolve(result);
                    app.wrapper.classList.remove('cdx-loader');

                }};



            xhr.send(JSON.stringify(result));
        };


        app.wrapper.appendChild(this.addr_list);
        app.wrapper.appendChild(this.from);
        //     app.wrapper.appendChild(this.to);
        app.wrapper.appendChild(button);
        if(this.data && this.data.addrs && this.data.addrs.length>0){
            app.show_all_addrs();
        }
        return app.wrapper;
    }

    save(blockContent){


        var result=this.data;


        return result;







    }
    validate(savedData){


        if((savedData.addrs && savedData.addrs.length>0)){
            return true;
        }




        return false;
    }
}
window.Maps=MapsPlugin;
