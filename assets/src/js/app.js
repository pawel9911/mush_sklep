document.addEventListener("DOMContentLoaded", function () {
  const accordionItems = document.querySelectorAll("#product-accordion li");
  const detailsItems = document.querySelectorAll(".product__details a");
  const otherContent = document.querySelectorAll(".product-accordion");

  detailsItems.forEach((e) => {
    e.addEventListener("click", (e) => {
      const target = e.currentTarget;
      const targetId = target.getAttribute("data-target");
      const targetContent = document.querySelector(targetId);
      const targetBtn = document.querySelector(`li[data-target="${targetId}"]`);

      targetBtn.scrollIntoView({behavior: "smooth"});

      targetBtn.classList.add("active");

      accordionItems.forEach((e) =>
        e !== targetBtn ? e.classList.remove("active") : null
      );

      targetContent.classList.add("active");

      otherContent.forEach((e) => {
        e !== targetContent ? e.classList.remove("active") : null;
      });
    });
  });

  accordionItems.forEach((e) => {
    e.addEventListener("click", function (e) {
      const target = e.currentTarget;
      const targetId = target.getAttribute("data-target");
      const targetContent = document.querySelector(targetId);

      target.classList.add("active");

      accordionItems.forEach((e) =>
        e !== target ? e.classList.remove("active") : null
      );

      targetContent.classList.add("active");

      otherContent.forEach((e) => {
        e !== targetContent ? e.classList.remove("active") : null;
      });
    });
  });
});
