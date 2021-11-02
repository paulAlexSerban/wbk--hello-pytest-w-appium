import './index.page.scss';
import GenericTemplate from '../../templates/generic/generic.template';

class IndexPage {
  constructor() {
    this.pageParams = {
      pageTitle: 'index',
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

const INDEX_PAGE = new IndexPage();
console.log(INDEX_PAGE);
