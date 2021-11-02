import './front-page.page.scss';
import UIkit from 'uikit';
import GenericTemplate from '../../templates/generic/generic.template';

class FrontPage {
  constructor() {
    this.pageParams = {
      pageTitle: 'home',
    };
    this.init();
    UIkit.notification('Hello world.');
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
