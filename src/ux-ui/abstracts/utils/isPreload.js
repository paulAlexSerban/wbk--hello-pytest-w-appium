export const isPreload = () => {
  window.addEventListener("load", () => {
    window.setTimeout(() => {
      document.querySelector("body").classList.remove("is-preload");
    }, 300);
  });
};
