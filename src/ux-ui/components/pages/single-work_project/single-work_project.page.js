import './single-work_project.page.scss';
import HomeTemplate from '../../templates/home/home.template';

class SingleWorkProjectPage {
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
    console.log(this.pageParams);
  }
}

document.querySelectorAll('[data-js-page="single-work_project-page"]').forEach((page) => new SingleWorkProjectPage(page));
