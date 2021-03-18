<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Instagram Photo</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  </head>
  <body>
    <div id="albums" style="float: left; width: 137px; height:400px; overflow-x: hidden; overflow-y: auto;"></div>
  	<div id="photos" style="float: right; width: 100%;" class="photos"></div>
  </body>
  <script>
window.onmessage = function(event) {
    switch(event.data) {
      case 'igphoto':
        igPhoto();
        break;
      case 'igtags':
        igTags();
          break;
      default:
        break;
    }
  }



    function getIGdata(){
      return new Promise((resolve, reject) => {
        var access_token = '232944893.19bf4ba.ce9a0a87fde242b99a2bce60789c31af';
        $.get("https://api.instagram.com/v1/users/self/media/recent/?access_token="+access_token, function(response){
          console.log('getIGdata:response', response)
          // return response;
          resolve(response);
        });
      });
    }

    async function igTags(){
        var igData = await getIGdata();
        var tags = {};
        // $.each(igData.data,function(k,v){
        //     if(v.tags.length() > 0) {
        //       $.each(v.tags.data,function(tk,tv){
        //         if(tags.indexOf(tv) === -1) {
        //           tags.push(tv);
        //         }
        //       });
        //     }
        //    //parent.postMessage(tagsIG,'*')
        // });
        console.log(tags);

    }

    async function igPhoto(){
        var igData = await getIGdata();
        $.each(igData.data,function(k,v){
      			postIG = '{"action":"igPhoto","id":"'+v.id+'","picture":"'+v.images.thumbnail.url+'","source":"'+v.images.standard_resolution.url+'"}';
      			parent.postMessage(postIG,'*')
      	});

    }


  </script>
</html>
