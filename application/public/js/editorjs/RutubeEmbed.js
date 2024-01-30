 class RutubeEmbed {

    static get pasteConfig() {
        return {
            // ... tags
            // ... files
            patterns: {
                link: /https:\/\/rutube\.ru\/video\/([a-zA-Z0-9_-]+)\/$/i
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
        var iframe=document.createElement("iframe");
        /*
        <script async src="https://telegram.org/js/telegram-widget.js?22" data-telegram-post="artemdevru/158" data-width="100%"></script>
         */
        var code_video=link.replace("https://rutube.ru/video/","").replace("/","");
        iframe.src="https://rutube.ru/play/embed/"+code_video;

        iframe.classList.add("embed-responsive-item");
        iframe.setAttribute("frameBorder","0");
        iframe.setAttribute("allow","clipboard-write; autoplay");
        iframe.setAttribute("webkitAllowFullScreen","");
        iframe.setAttribute("mozallowfullscreen","");
        iframe.setAttribute("allowFullScreen","");


        app.wrapper.appendChild(iframe);
        app.data={"link":link,"video_code":code_video};


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
        if(!savedData.video_code){
            return false;
        }





        return true;
    }
}
window.RutubeEmbed=RutubeEmbed;
