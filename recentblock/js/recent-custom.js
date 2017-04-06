(function ($) {
  Drupal.behaviors.recentblock = {
    attach: function (context, settings) {
     $(".load-detail").click(function(e){
        var nid = this.id; 
        e.preventDefault()
        var baseUrl = document.location.origin;
        var urlactivity = baseUrl + '/recentact/' + nid;
      //  alert(url);
        
         $.ajax({
             url:urlactivity,
             type: 'POST',
             success: function (data) {
                 var json_obj = $.parseJSON(data);
                 console.log(json_obj);
                 var outputDate = json_obj.activityDate;
                 var outputDesc = json_obj.activityDesc;
                 var OutputImg ='<img src=' + json_obj.imageurl + '/>';
                $(".activity-load-date").html(outputDate);
                $(".activity-desc-load").html(outputDesc);
                $(".img-container").html(OutputImg);

             }
        });
        return false;
     });
    }
  };
})(jQuery);

