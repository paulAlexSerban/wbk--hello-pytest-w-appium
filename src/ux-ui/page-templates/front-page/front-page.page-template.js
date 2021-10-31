import GenericTemplate from '../../templates/generic/generic.template';

class FrontPage {
  constructor() {
    this.pageParams = {
      pageTitle: 'home',
    };
    this.GENERIC_PAGE = new GenericTemplate(this.pageParams);
    this.init();
  }

  init() {
    console.log('front-page template loaded');
  }
}

const FRONT_PAGE = new FrontPage();
