// JavaScript Document
jQuery(document).ready(function($){
	
	$(".rwd-container").hide();

	$("h3.rwd-toggle").click(function(){
	$(this).toggleClass("active").next().slideToggle("fast");
		return false; //Prevent the browser jump to the link anchor
	});

});

jQuery(document).ready(function ($) {
    setTimeout(function () {
        $(".fade").fadeOut("slow", function () {
            $(".fade").remove();
        });

    }, 2000);
});

jQuery(document).ready(function($){
            $("#ArticoliDisp").sortable({ connectWith: '#post-list',		
			update: function(event, ui) {
					$('#loading-animation').show(); // Show the animate loading gif while waiting
		 
					opts = {
						url: ajaxurl, // ajaxurl is defined by WordPress and points to /wp-admin/admin-ajax.php
						type: 'POST',
						async: true,
						cache: false,
						dataType: 'json',
						data:{
							action: 'post_homeboxes_sort', // Tell WordPress how to handle this ajax request
							order: $('#post-list').sortable('toArray').toString() // Passes ID's of list items in	1,3,2 format
						},
						success: function(response) {
							$('#loading-animation').hide(); // Hide the loading animation
							return; 
						},
						error: function(xhr,textStatus,e) {  // This can be expanded to provide more information
							alert('Si è verificato un errore durante la memorizzazione degli aggiornamenti');
							$('#loading-animation').hide(); // Hide the loading animation
							return; 
						}
					};
					$.ajax(opts);
				}
                });
                
            $("#post-list").sortable({ connectWith: '#ArticoliDisp',
 			update: function(event, ui) {
					$('#loading-animation').show(); // Show the animate loading gif while waiting
		 
					opts = {
						url: ajaxurl, // ajaxurl is defined by WordPress and points to /wp-admin/admin-ajax.php
						type: 'POST',
						async: true,
						cache: false,
						dataType: 'json',
						data:{
							action: 'post_homeboxes_sort', // Tell WordPress how to handle this ajax request
							order: $('#post-list').sortable('toArray').toString() // Passes ID's of list items in	1,3,2 format
						},
						success: function(response) {
							$('#loading-animation').hide(); // Hide the loading animation
							return; 
						},
						error: function(xhr,textStatus,e) {  // This can be expanded to provide more information
							alert('Si è verificato un errore durante la memorizzazione degli aggiornamenti');
							$('#loading-animation').hide(); // Hide the loading animation
							return; 
						}
					};
					$.ajax(opts);
				}
            });

});