<?php

namespace App\Api\UI\EditorJS;

use App\Http\Requests\LinkEditorJsRequest;

class LinkToolRepository
{


    public function fetch(LinkEditorJsRequest $request){

        $url=$request->getUrl();
        $metaResults = \Kovah\HtmlMeta\Facades\HtmlMeta::forUrl($url);

        $response = $metaResults->getResponse(); // Illuminate\Http\Client\Response
        $metaTags = $metaResults->getMeta(); // array
        $url = $metaResults->getUrl(); // string

        $result_meta=[];

        if(isset($metaTags) and is_array($metaTags)){


            if(isset($metaTags['title'])){
                $result_meta['title']=$metaTags['title'];

            }
            if(isset($metaTags['og:site_name'])){
                $result_meta['site_name']=$metaTags['og:site_name'];
            }
            if(isset($metaTags['description'])){
                $result_meta['description']=$metaTags['description'];
            }
            if(isset($metaTags['og:image'])){
                $result_meta['image']=["url"=>$metaTags['og:image']];
            }


        }
        if(!(isset($result_meta['site_name']))){
            $parse_url=parse_url($url);
            $result_meta['site_name']=$parse_url['host'];
        }


        return array('success' => 1,'link'=>$url, 'meta' => $result_meta);
    }

}
