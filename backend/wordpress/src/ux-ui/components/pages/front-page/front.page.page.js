import "./front-page.page.scss";
import HomeTemplate from "../../templates/home/home.template";

class FrontPage {
  constructor(page) {
    this.pageParams = {
      pageNode: page,
      pageTitle: page.dataset.jsPage,
    };

    this.init();
  }

  setupTemplate() {
    this.HOME_TEMPLATE = new HomeTemplate(this.pageParams);
  }

  init() {
    this.setupTemplate();
  }
}

document
  .querySelectorAll('[data-js-page="front-page"]')
  .forEach((page) => new FrontPage(page));
