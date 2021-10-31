import Navigation from '../../components/molecules/navigation/navigation.molecule';
import Header from '../../components/organisms/header/header.organism';

import './generic.template.scss';

export default class GenericTemplate {
  constructor(pageParams) {
    this.pageParams = pageParams;
    this.templateParams = {
      templateName: 'generic'
    };
    this.NAVIGATION = new Navigation(this.pageParams, this.templateParams);
    this.HEADER = new Header(this.pageParams, this.templateParams);
    this.init();
  }

  init() {
    console.log('generic template loaded', this.pageParams);
  }
}