export default class Header {
  constructor(pageParams, templateParams) {
    this.pageParams = pageParams;
    this.templateParams = templateParams;
    this.init();
  }

  init() {
    console.log('header is loaded', this.pageParams, this.templateParams);
  }
}