export default class Navigation {
  constructor(pageParams, templateParams) {
    this.pageParams = pageParams;
    this.templateParams = templateParams;
    this.init();
  }

  init() {
    console.log('navigation is loaded', this.pageParams, this.templateParams);
  }
}