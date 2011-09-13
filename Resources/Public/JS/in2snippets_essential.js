jQuery(document).ready(function() {
	// set focus to searchform
	$('.in2snippets_search_form_textfield').focus();
	
	var votesCalc = $('input#hiddenVotesCalc').val();
	var votesCalcRounded = Math.round(votesCalc);
	
	in2snippets_essential_init();
	in2snippets_stars_highlight(votesCalcRounded);
	in2snippets_snippetoptions_slideToggle();
	in2snippets_stars_mouseover();
	in2snippets_stars_mouseout(votesCalcRounded)
	
});	
	/*
	 * DETAIL
	 */
	
	/*
	 * Essential Initializefunction for hiding all options-container and styling the code
	 * 
	 * @return void
	 */
	function in2snippets_essential_init() {
		$('div.in2snippets_detail_snippet_options_newcomment_form').hide();
		$('div.in2snippets_detail_snippet_options_share_popup').hide();
		$('div.in2snippets_detail_snippet_options_tipafriend_form').hide();
		$('div.in2snippets_detail_snippet_options_votes_popup').hide();

		if ($('.someCode').length > 0) {
			$.beautyOfCode.init({
				brushes: ['Css', 'Xml', 'Sql', 'JScript', 'Plain', 'Php'],
				ready: function() {
					$.beautyOfCode.beautifyAll();
					$('.someCode').beautifyCode('javascript', {gutter:false});
				}
			});
		}
		$(".in2snippets_detail_snippet_comment:odd").each(function() {
			$(this).addClass('in2snippets_detail_snippet_comment_odd');
		});
		
	}
	
	/*
	 * Setting Highlighted class and image-source for Vote-Stars at page-load (calculated sum of votes)
	 * 
	 * @param votesCalcRounded
	 * @return void
	 */
	function in2snippets_stars_highlight(votesCalcRounded) {
		$('img.in2snippets_detail_snippet_options_votes_popup_stars_star').slice(0, votesCalcRounded).addClass('in2snippets_detail_snippet_options_votes_popup_stars_star_highlighted');
		$('img.in2snippets_detail_snippet_options_votes_popup_stars_star').slice(0, votesCalcRounded).attr('src', 'typo3conf/ext/in2snippets/Resources/Public/Icons/Stuff/star_filled.png');
	}

	/*
	 * There will follow some slideToggle (pop-down) effects for the Snippet-Options
	 * 
	 * @return void
	 */ 
	function in2snippets_snippetoptions_slideToggle() {
		$('div.in2snippets_detail_snippet_options_newcomment').click(function() {
			$('div.in2snippets_detail_snippet_options_newcomment_form').slideToggle('500');
			$('div.in2snippets_detail_snippet_options_newcomment_form').siblings('div').slideUp('500');
		});
		
		$('div.in2snippets_detail_snippet_options_rate').click(function() {
			var votesCalc = $('input#hiddenVotesCalc').val();
			var votesCalcRounded = Math.round(votesCalc);
			in2snippets_stars_highlight(votesCalcRounded);
			in2snippets_stars_mouseout(votesCalcRounded);
			$('div.in2snippets_detail_snippet_options_votes_popup').slideToggle('500');
			$('div.in2snippets_detail_snippet_options_votes_popup').siblings('div').slideUp('500');
		});
		$('div.in2snippets_detail_snippet_options_tipafriend').click(function() {
			$('div.in2snippets_detail_snippet_options_tipafriend_form').slideToggle('500');
			$('div.in2snippets_detail_snippet_options_tipafriend_form').siblings('div').slideUp('500');
		});

		$('div.in2snippets_detail_snippet_options_share').click(function() {
			$('div.in2snippets_detail_snippet_options_share_popup').slideToggle('500');
			$('div.in2snippets_detail_snippet_options_share_popup').siblings().slideUp('500');
		});
	}
	
	/*
	 * Mouse-Over-Effect for Voting-Stars (adding class highlighted & changing the source)
	 * 
	 * @return void
	 */
	function in2snippets_stars_mouseover() {
		$('img.in2snippets_detail_snippet_options_votes_popup_stars_star').mouseover(function(){
			$(this).parent('a').parent('div').children('a').children('img').removeClass('in2snippets_detail_snippet_options_votes_popup_stars_star_highlighted');
			$(this).parent('a').parent('div').children('a').children('img').attr('src', 'typo3conf/ext/in2snippets/Resources/Public/Icons/Stuff/star_normal.png');
			$(this).addClass('in2snippets_detail_snippet_options_votes_popup_stars_star_highlighted');
			$(this).attr('src', 'typo3conf/ext/in2snippets/Resources/Public/Icons/Stuff/star_filled.png');
			$(this).parent('a').prevUntil().children('img').addClass('in2snippets_detail_snippet_options_votes_popup_stars_star_highlighted');
			$(this).parent('a').prevUntil().children('img').attr('src', 'typo3conf/ext/in2snippets/Resources/Public/Icons/Stuff/star_filled.png');
		});
	}

	/*
	 * Mouse-Out-Effect for Voting-Stars (adding class highlighted & changing the source)
	 * 
	 * @param	votesCalcRounded
	 * @return	void
	 */
	function in2snippets_stars_mouseout(votesCalcRounded) {
		$('div.in2snippets_detail_snippet_options_votes_popup_stars').mouseout(function(){
			$(this).children('a').children('img').removeClass('in2snippets_detail_snippet_options_votes_popup_stars_star_highlighted');
			$(this).children('a').children('img').attr('src', 'typo3conf/ext/in2snippets/Resources/Public/Icons/Stuff/star_normal.png');
			$('img.in2snippets_detail_snippet_options_votes_popup_stars_star').slice(0, votesCalcRounded).addClass('in2snippets_detail_snippet_options_votes_popup_stars_star_highlighted');
			$('img.in2snippets_detail_snippet_options_votes_popup_stars_star').slice(0, votesCalcRounded).attr('src', 'typo3conf/ext/in2snippets/Resources/Public/Icons/Stuff/star_filled.png');
		});
	}