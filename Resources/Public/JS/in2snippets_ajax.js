jQuery(document).ready(function(){
	var baseurl = $('base').attr('href'); // read base url
	if (baseurl == undefined) {
		alert('Please set a baseurl in your TYPO3-Configuration!')
	}
		
	var pid = $('#in2snippets_container_pid').val(); // read current page id

	// hide submit button
	$('.in2snippets_search_form_submit').hide();
	
	// deactivate submit
	$('.in2snippets_search_form').submit(function(e) {
		e.preventDefault();
	});

	// ajax request on searchfield
	$('input.in2snippets_search_form_textfield').live('keyup, keypress', function(e) {
		var keyupthis = $(this);
		delay(function() {
			$('.backtocat').hide(); // hide back link
			$('.in2snippets_ajax_container_detail').slideUp(); // close detail view

			if (keyupthis.val().length > 2 || e.keyCode == 13) { // if 3 or more signs in searchfield OR "Return" is pressed
				$.ajax({
					url: baseurl + 'index.php?eID=in2snippets_search&id=' + pid + '&tx_in2snippets_pi1[snippetSearch]=' + keyupthis.val(),
					cache: false, // disable cache (for ie)
					success: function(data) {
						$('.in2snippets_ajax_container_list').html(data).slideDown();
					},
					beforeSend: function(jqXHR, settings) {
						$('body').css('cursor', 'wait');
					},
					complete: function(jqXHR, textStatus) {
						$('body').css('cursor', 'default');
					}
				});
			}
		}, (e.keyCode == 13 ? 0 : 400) ) // wait for 400ms (if "Return" is pressed 0ms)
	});

	// ajax request on detail link
	$('.in2snippets_detaillink').live('click', function(e) {
		$('.backtocat').hide(); // hide back link
		$('.in2snippets_ajax_container_list').slideUp(); // close list view
		var uid = $(this).attr('rel');

		$.ajax({
			url: baseurl + 'index.php?eID=in2snippets_detail&id=' + pid + '&tx_in2snippets_pi1[snippet]=' + uid,
			cache: false, // disable cache (for ie)
			beforeSend: function(jqXHR, settings) {
				$('body').css('cursor', 'wait');
				$('#overlay').show();
			},
			complete: function(jqXHR, textStatus) {
				$('body').css('cursor', 'default');
				$('#overlay').hide();
			},
			success: function(data) {
				$('.in2snippets_ajax_container_detail').html(data).slideDown();
				$('.backtocat').fadeIn().css('display', 'block');
				
				in2snippets_essential_init();
				in2snippets_snippetoptions_slideToggle();
				in2snippets_stars_mouseover();
			}
		});

		e.preventDefault();
	});

	// Click on a tag
	$('.in2snippets_detail_snippet_tags_list_tag a').live('click', function(e) {
		$('.backtocat').hide(); // hide back link
		$('.in2snippets_ajax_container_detail').slideUp(); // close detail view
		$('.in2snippets_search_form_textfield').val($(this).html()); // write tag into searchform
		
		$.ajax({
			url: baseurl + 'index.php?eID=in2snippets_search&id=' + pid + '&tx_in2snippets_pi1[snippetSearch]=' + $(this).html(),
			cache: false, // disable cache (for ie)
			success: function(data) {
				$('.in2snippets_ajax_container_list').html(data).slideDown();
			},
			beforeSend: function(jqXHR, settings) {
				$('body').css('cursor', 'wait');
			},
			complete: function(jqXHR, textStatus) {
				$('body').css('cursor', 'default');
			}
		});

		e.preventDefault();
	});

	// ajax request on newcomment form
	$('.in2snippets_detail_snippet_options_newcomment_form form').live('submit', function(e) {
		var date = currentDate();
		var time = currentTime();
		var error = 0;
		var url = baseurl + 'index.php?eID=in2snippets_comment&id=' + pid;
		$('.in2snippets_detail_snippet_options_newcomment_form form .in2snippets_form_required').each(function() {
			if ($(this).val() == '') {
				error = 1;
			}
		});

		if (error) {
			$('.in2snippets_detail_snippet_options_newcomment_form_errors').html($('.in2snippets_error_nodata').val());
			$('.in2snippets_detail_snippet_options_newcomment_form_errors').fadeIn('1000').delay('1500').fadeOut('1000');
			
			e.preventDefault();
		} else {
			$.ajax({
				url: url,
				cache: false,
				type: 'POST',
				data: $('.in2snippets_detail_snippet_options_newcomment_form form').serialize(),

				success: function(data) {
					$('.in2snippets_detail_snippet_comment_new_outer .in2snippets_detail_snippet_comment_info_creator a').text($('#in2snippets_comment_new_form_name').val());
					$('.in2snippets_detail_snippet_comment_new_outer .in2snippets_detail_snippet_comment_info_creator a').attr('href', $('#in2snippets_comment_new_form_www').val());
					$('.in2snippets_detail_snippet_comment_new_outer .in2snippets_detail_snippet_comment_info_date').text(date + ' - ' + time);
					$('.in2snippets_detail_snippet_comment_new_outer .in2snippets_detail_snippet_comment_text').html($('#in2snippets_comment_new_form_comment').val());
					$('.in2snippets_detail_snippet_comment_new_outer').fadeIn('500');
					$('div.in2snippets_detail_snippet_options_newcomment_form').slideUp('500', function(){
						$('div.in2snippets_infocontainer').html($('.in2snippets_thanksforcomment').val()).delay('100').slideDown('500').delay('2000').slideUp('500');
					});
				}
			});

			e.preventDefault();
		}
	});

	// ajax request on tipafriend form
	$('.in2snippets_detail_snippet_options_tipafriend_form form').live('submit', function(e) {
		var url = baseurl + 'index.php?eID=in2snippets_tipafriend&id=' + pid;
		var error = 0;
		var invalidMail = 0;
		
		$('.in2snippets_detail_snippet_options_tipafriend_form form .in2snippets_form_required').each(function() {
			if ($(this).val() == '') {
				error = 1;
			}
		});
		
		$('.in2snippets_detail_snippet_options_tipafriend_form form .in2snippets_form_mail').each(function() {
			if (validEmail($(this).val()) == false) {
				invalidMail = 1;
			}
		});
		
		if (error) {
			$('.in2snippets_detail_snippet_options_tipafriend_form_errors').html($('.in2snippets_error_nodata').val());
			$('.in2snippets_detail_snippet_options_tipafriend_form_errors').fadeIn('1000').delay('1500').fadeOut('1000');
			
			e.preventDefault();
		} else if (invalidMail) {
			$('.in2snippets_detail_snippet_options_tipafriend_form_errors').html($('.in2snippets_error_invalidmail').val());
			$('.in2snippets_detail_snippet_options_tipafriend_form_errors').fadeIn('1000').delay('1500').fadeOut('1000');
			
			e.preventDefault();
		} else {
			$.ajax({
				url: url,
				cache: false,
				type: 'POST',
				data: $('.in2snippets_detail_snippet_options_tipafriend_form form').serialize(),
				
				success: function(data) {
					$('div.in2snippets_detail_snippet_options_tipafriend_form').slideUp('500', function(){
						$('div.in2snippets_infocontainer').html($('.in2snippets_thanksfortip').val()).delay('100').slideDown('500').delay('2000').slideUp('500');
					});
				}
			});

			e.preventDefault();
		}
	});

		

	// ajax request for votes
	$('.in2snippets_detail_snippet_options_votes_popup_stars a').live('click', function(e) {
		var uid = $('.in2snippets_snippetuid').val();
		var votenum = $(this).attr('rel');
		var url = baseurl + 'index.php?eID=in2snippets_vote&id=' + pid + '&tx_in2snippets_pi1[snippet]=' + uid + '&tx_in2snippets_pi1[votenum]=' + votenum;

		$.ajax({
			url: url,
			cache: false,
			beforeSend: function(jqXHR, settings) {
				$('body').css('cursor', 'wait');
			},
			complete: function(jqXHR, textStatus) {
				$('body').css('cursor', 'default');
			},
			success: function(data) {
				var votesCalc = data;
				var votesCalcRounded = Math.round(votesCalc);
				var votesCalcRounded2Comma = round2comma(votesCalc);
				$('span.in2snippets_detail_snippet_options_votes_popup_stars_calc').html('(' + votesCalcRounded2Comma + ')');
				in2snippets_stars_highlight(votesCalcRounded);
				in2snippets_stars_mouseout(votesCalcRounded);
				$('div.in2snippets_detail_snippet_options_votes_popup').delay('500').slideUp('500', function(){
					$('div.in2snippets_infocontainer').html($('.in2snippets_thanksforvoting').val()).delay('100').slideDown('500').delay('2000').slideUp('500');
				});
			}
		});

		e.preventDefault();
	});

	// Back link on ajax categories
	$('.backtocat').live('click', function(e) {
		$('.in2snippets_ajax_container_detail').slideUp(); // close detail view
		$('.in2snippets_ajax_container_list').slideDown(); // open list view
		$(this).hide();

		e.preventDefault();
	});

	// Delay function
	var delay = (function(){
		var timer = 0;
		return function(callback, ms){
			clearTimeout (timer);
			timer = setTimeout(callback, ms);
		};
	})();
	
	// Function for calculating a rounded number for 2 positions after comma
	function round2comma(calc) {
		aftercom = 2;
		if (aftercom < 1 || aftercom > 14) return false;
		var e = Math.pow(10, aftercom);
		var k = (Math.round(calc * e) / e).toString();
		if (k.indexOf('.') == -1) k += '.';
		k += e.toString().substring(1);
		return k.substring(0, k.indexOf('.') + aftercom + 1);
	}
	
	/**
	 * Check if given String is a valid Email address
	 *
	 * @param	string		An email address
	 * @return	boolean		valid true or false
	 */
	function validEmail(s) {
		var a = false;
		var res = false;
		if(typeof(RegExp) == 'function') {
			var b = new RegExp('abc');
			if(b.test('abc') == true){a = true;}
		}
			if (a == true) {
			reg = new RegExp('^([a-zA-Z0-9\\-\\.\\_]+)' + '(\\@)([a-zA-Z0-9\\-\\.]+)'+ '(\\.)([a-zA-Z]{2,4})$');
			res = (reg.test(s));
		} else {
			res = (s.search('@') >= 1 && s.lastIndexOf('.') > s.search('@') && s.lastIndexOf('.') >= s.length-5);
		}
		return(res);
	}
	
	/*
	 * Get current Date
	 * 
	 * @return string current Date
	 */
	function currentDate() {
		var currentDate = new Date();
		var day = currentDate.getDate();
		var month = currentDate.getMonth() + 1;
		var year = currentDate.getFullYear();
		
		if (day < 10) {
			day = '0' + day;
		}
		if (month < 10) {
			month = '0' + month;
		}
		return (day + '.' + month + '.' + year);
	}
	
	/*
	 * Get current Time
	 * 
	 * @return string current Time
	 */
	function currentTime() {
		var currentTime = new Date();
		var hours = currentTime.getHours();
		var minutes = currentTime.getMinutes();

		if (minutes < 10) {
			minutes = '0' + minutes;
		}
		return(hours + ':' + minutes);
	}

});