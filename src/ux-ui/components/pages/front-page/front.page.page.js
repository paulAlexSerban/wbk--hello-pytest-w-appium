import './front-page.page.scss';
import GenericTemplate from '../../templates/generic/generic.template';

class FrontPage {
  constructor() {
    this.pageParams = {
      pageTitle: 'home',
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

const FRONT_PAGE = new FrontPage();
console.log(FRONT_PAGE);
