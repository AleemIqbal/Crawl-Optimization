jQuery(document).ready(function ($) {
  // when the global comment feeds checkbox is changed
  $('#ultimatecrawloptimizer_remove_global_comment_feeds')
    .change(function () {
      // if the global comment feeds checkbox is checked
      if ($(this).is(':checked')) {
        // check the post comment feeds checkbox and disable it
        $('#ultimatecrawloptimizer_remove_post_comments_feeds').prop('checked', true).prop('disabled', true);
      }
      // if the global comment feeds checkbox is unchecked
      else {
        // uncheck the post comment feeds checkbox and enable it
        $('#ultimatecrawloptimizer_remove_post_comments_feeds').prop('checked', false).prop('disabled', false);
      }
    })
    .change(); // trigger the change event to set initial state
});
jQuery(document).ready(function ($) {
  // when the filter search terms checkbox is changed
  $('#ultimatecrawloptimizer_filter_search_terms')
    .change(function () {
      // if the filter search terms checkbox is checked
      if ($(this).is(':checked')) {
        // enable the input and checkboxes
        $('#ultimatecrawloptimizer_filter_search_terms_value, #ultimatecrawloptimizer_filter_special_characters, #ultimatecrawloptimizer_filter_spam_patterns').prop('disabled', false);
      }
      // if the filter search terms checkbox is unchecked
      else {
        // disable and uncheck the input and checkboxes
        $('#ultimatecrawloptimizer_filter_search_terms_value, #ultimatecrawloptimizer_filter_special_characters, #ultimatecrawloptimizer_filter_spam_patterns').prop('disabled', true).prop('checked', false);
      }
    })
    .change(); // trigger the change event to set initial state
});
jQuery(document).ready(function ($) {
  // when the remove unregistered url params checkbox is changed
  $('#ultimatecrawloptimizer_remove_unregistered_url_params')
    .change(function () {
      // if the remove unregistered url params checkbox is checked
      if ($(this).is(':checked')) {
        // enable the allowed url params input text field
        $('#ultimatecrawloptimizer_allowed_url_params').prop('disabled', false);
      }
      // if the remove unregistered url params checkbox is unchecked
      else {
        // disable the allowed url params input text field and clear its value
        $('#ultimatecrawloptimizer_allowed_url_params').prop('disabled', true);
      }
    })
    .change(); // trigger the change event to set initial state
});
