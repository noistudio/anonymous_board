class FigmaEmbed {

    static get pasteConfig() {
        return {
            // ... tags
            // ... files
            patterns: {
                link: /https:\/\/([\w\.-]+\.)?figma.com\/(file|proto)\/([0-9a-zA-Z]{22,128})(?:\/.*)?$/i
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
        ///var code_video=link.replace("https://rutube.ru/video/","").replace("/","");
        var iframe_src='https://www.figma.com/embed?embed_host=share&url='+link;
        iframe.src=iframe_src;

        iframe.classList.add("embed-responsive-item");
        iframe.setAttribute("frameBorder","0");
        iframe.setAttribute("width","100%");
        iframe.setAttribute("style","min-height:450px;border: 1px solid rgba(0, 0, 0, 0.1);");

        iframe.setAttribute("allowFullScreen","");


        app.wrapper.appendChild(iframe);
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
window.FigmaEmbed=FigmaEmbed;
