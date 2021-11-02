import './project.template.scss';
import Navigation from '../../molecules/navigation/navigation.molecule';
import Header from '../../organisms/header/header.organism';
import Footer from '../../organisms/footer/footer.organism';

export default class ProjectTemplate {
  constructor(pageParams) {
    this.pageParams = pageParams;
    this.templateParams = {
      templateName: 'generic',
    };
    this.NAVIGATION = new Navigation(this.pageParams, this.templateParams);
    this.HEADER = new Header(this.pageParams, this.templateParams);
    this.FOOTER = new Footer(this.pageParams, this.templateParams);
    this.init();
  }

  init() {
    console.log('project template loaded', this.pageParams);
  }
}
