import './single-work_project.page.scss';
import ProjectTemplate from '../../templates/project/project.template';

class SingleWorkProjectPage {
  constructor(page) {
    this.pageParams = {
      pageNode: page,
      pageTitle: page.dataset.jsPage,
    };

    this.init();
  }

  setupTemplate() {
    this.PROJECT_TEMPLATE = new ProjectTemplate(this.pageParams);
  }

  init() {
    this.setupTemplate();
  }
}

document.querySelectorAll('[data-js-page="single-work_project-page"]').forEach((page) => new SingleWorkProjectPage(page));
