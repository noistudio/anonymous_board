class VkClipsEmbed {

    static get pasteConfig() {
        return {
            // ... tags
            // ... files
            patterns: {
                link: /https:\/\/vk\.com\/clip([a-zA-Z0-9_-]+)$/i
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
       // var div=document.createElement("div");


        var iframe=document.createElement("iframe");

        var code_video=link.replace("https://vk.com/clip","");
        var code_arr=code_video.split("_");
        var url="https://vk.com/video_ext.php?oid="+code_arr[0]+"&id="+code_arr[1]+"&hd=2";
        iframe.src=url;
        iframe.classList.add("embed-responsive-item");


        iframe.setAttribute("frameBorder","0");

        iframe.setAttribute("allow","clipboard-write; autoplay");
        iframe.setAttribute("webkitAllowFullScreen","");
        iframe.setAttribute("mozallowfullscreen","");
        iframe.setAttribute("allowFullScreen","");

        //div.appendChild(iframe);

        app.wrapper.appendChild(iframe);
        app.data={"link":link,"iframe_url":url};


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
        if(!savedData.iframe_url){
            return false;
        }





        return true;
    }
}
window.VkClipsEmbed=VkClipsEmbed;
