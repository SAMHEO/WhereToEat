var endpoint = "https://wheretoeat.cognitiveservices.azure.com/";
var subkey = "a21d1dd0607d4df3a568c830f17f2578";

// After user writes a review, analyze the text and recommends rating score based on their review
$(function() {
  $("#review-comment").blur(function() {
    analyzeText();
  });
});

// Analyze text and returns positivity of a text
function analyzeText() {
  var params = {
    // Request parameters
    showStats: false
  };

  var textObj = {
    documents: [
      {
        language: "en",
        id: 1,
        text: $("#review-comment").val()
      }
    ]
  };

  // Sends ajax reqeust to MS Azure ML API
  $.ajax({
    url: endpoint + "text/analytics/v2.1/sentiment?" + $.param(params),
    beforeSend: function(xhrObj) {
      // Request headers
      xhrObj.setRequestHeader("Content-Type", "application/json");
      xhrObj.setRequestHeader("Ocp-Apim-Subscription-Key", subkey);
    },
    type: "POST",
    // Request body
    data: JSON.stringify(textObj)
  })
    // Returned data has sentiment score
    .done(function(data) {
      var score = data.documents[0].score;
      if (score > 0 && score < 0.2) {
        $(".analyzed-text")
          .fadeIn()
          .html("Recommended Rating Based on Your Comment: 1");
      } else if (score < 0.4) {
        $(".analyzed-text")
          .fadeIn()
          .html("Recommended Rating Based on Your Comment: 2");
      } else if (score < 0.6) {
        $(".analyzed-text")
          .fadeIn()
          .html("Recommended Rating Based on Your Comment: 3");
      } else if (score < 0.8) {
        $(".analyzed-text")
          .fadeIn()
          .html("Recommended Rating Based on Your Comment: 4");
      } else {
        $(".analyzed-text")
          .fadeIn()
          .html("Recommended Rating Based on Your Comment: 5");
      }
    })
    .fail(function() {
      alert("error");
    });
}
