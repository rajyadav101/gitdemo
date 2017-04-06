(function ($) {
  Drupal.behaviors.news = {
    attach: function (context, settings) {
     $(".loadnewsdesc").click(function(e){
        var nid = this.id; 
        e.preventDefault()
        var baseUrl = document.location.origin;
        var urlactivity = baseUrl + '/newsdetail/' + nid;
      //  alert(url);
        
         $.ajax({
             url:urlactivity,
             type: 'POST',
             success: function (data) {
                 var json_obj = $.parseJSON(data);
                 console.log(json_obj);
                 var outputDate = json_obj.newslink;
                 var outputDesc = json_obj.activityDesc;
                 var readylink = '<a target="_blank" href=' +outputDate+ '> More..</a>';
                $(".loadlink").html(readylink);
                $(".loadnews").html(outputDesc);

             }
        });
        return false;
     });
    }
  };
})(jQuery);

