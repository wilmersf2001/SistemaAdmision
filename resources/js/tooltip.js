document.addEventListener("DOMContentLoaded", function() {
  const questionTriggers = document.querySelectorAll(".question-trigger");
  questionTriggers.forEach(function(trigger) {
      trigger.addEventListener("mouseenter", function() {
          const popover = this.nextElementSibling;
          popover.style.display = "flex";
      });
      trigger.addEventListener("mouseleave", function() {
          const popover = this.nextElementSibling;
          popover.style.display = "none";
      });
  });
});