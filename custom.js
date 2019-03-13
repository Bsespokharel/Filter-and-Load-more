var ajaxCompleted = true;
var paged = 2;
jQuery(document).ready(function($) {
    jQuery(function($){
        var canBeLoaded = true;
        var bottomOffset =  $('.subscribe-section').offset().top - ($(window).height() / 2);
        $(window).scroll(function(){
            console.log(canBeLoaded);
            if( $(document).scrollTop() >  bottomOffset  && canBeLoaded == true ){   

                var click_limit = $('#total_post').attr('data-readmore_counter');          
                var type = $('.filters select#news-cat :selected').val();
                var sort = $('.filters select#news-sort :selected').val();
                $.ajax({
                    type : "post",
                    url : Fortiusobj.ajaxurl,
                    data : {
                        'action': 'fortius_loadmore_news_media',
                        'type': type,
                        'sort': sort,
                        'security' : Fortiusobj.ajax_nonce,
                        'paged' : paged,
                    },
                    beforeSend: function( xhr ) {
                        $('#loadingDiv').show();
                        canBeLoaded = false; 
                    },
                    success: function(response) {
                        if ( response.success != false ) {
                            $('.filter-results .container .filter-row').append(response);
                            console.log(paged);
                            Masonary.Isotope();
                            canBeLoaded = true; 
                            ajaxCompleted = true; 
                            paged++;
                            $('#loadingDiv').hide();

                        } else{
                            canBeLoaded = false; 
                            ajaxCompleted = false;
                            $('#loadingDiv').hide();
                        }
                    },
                    fail: function() {
                        console.log("error");
                    },
                    always: function() {
                        console.log("complete");
                    },
                });
            }
        }); 
        $('.filters select#news-cat, .filters select#news-sort').on('change', function (e) {
            paged = 1;
            e.preventDefault();
            var type = $('.filters select#news-cat :selected').val();
            var sort = $('.filters select#news-sort :selected').val();
            $.ajax({
                type : "post",
                url : Fortiusobj.ajaxurl,
                data : {
                    'action': 'fortius_filter_news_media',
                    'type': type,
                    'sort': sort,
                    'security' : Fortiusobj.ajax_nonce,
                    'paged' : paged
                },
                beforeSend: function( xhr ) {
                    $('#loadingDiv').show();
                },
                success: function(response) {
                    $('.filter-results .container').html(response);
                    $('#loadingDiv').hide();
                    Masonary.Isotope();
                    canBeLoaded = true;
                    ajaxCompleted = true;
                    paged++;
                },
                fail: function() {
                    console.log("error");
                },
                always : function() {
                    console.log("complete");
                }
            });
        });
        // iNFINITE LOAD MORE
    });
});    