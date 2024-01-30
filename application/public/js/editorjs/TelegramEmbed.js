 class TelegramEmbed {

    static get pasteConfig() {
        return {
            // ... tags
            // ... files
            patterns: {
                link: /https:\/\/t\.me\/([a-zA-Z0-9_-]+)\/([0-9]+)$/i
            }
        }
    }

    constructor({data, api, config}){
        this.api = api;

        this.data = data;
        this.config = config || {};
        this.wrapper = undefined;
    }

    render(){
        var app=this;
        app.wrapper=document.createElement("div");
        app.wrapper.classList.add("cdx-block");
        if(app.data && app.data.link){
            app.createWidget(app.data.link);
        }

        return app.wrapper;
    }
    createWidget(link){

        var app=this;
        var script=document.createElement("script");
        /*
        <script async src="https://telegram.org/js/telegram-widget.js?22" data-telegram-post="artemdevru/158" data-width="100%"></script>
         */
        script.src="https://telegram.org/js/telegram-widget.js?22";
        script.async = true;
        var short_url=link.replace("https://t.me/",'');
        script.setAttribute("data-telegram-post", short_url);
        script.setAttribute("data-width", "100%");
        script.setAttribute("data-dark", "1");
        app.wrapper.appendChild(script);
        app.data={"link":link};


    }

    onPaste(event){
        switch (event.type){
            // ... case 'tag'
            // ... case 'file'
            case 'pattern':
                const link = event.detail.data;

                this.createWidget(link);
                break;
        }
    }

    save(blockContent){


        var result=this.data;


        return result;







    }
    validate(savedData){

        if(!savedData.link){
            return false;
        }





        return true;
    }
}
window.TelegramEmbed=TelegramEmbed;
