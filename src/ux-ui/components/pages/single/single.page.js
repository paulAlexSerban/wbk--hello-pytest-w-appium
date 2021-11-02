import './single.page.scss';
import GenericTemplate from '../../templates/generic/generic.template';

class PagePage {
  constructor() {
    this.pageParams = {
      pageTitle: 'single page',
    };
    this.init();
  }

  setupTemplate() {
    this.GENERIC_PAGE = new GenericTemplate(this.pageParams);
  }

  init() {
    this.setupTemplate();
  }
}

const DEFAULT_PAGE = new PagePage();
console.log(DEFAULT_PAGE);
