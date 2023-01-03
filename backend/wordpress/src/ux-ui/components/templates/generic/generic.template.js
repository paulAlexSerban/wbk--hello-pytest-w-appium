import Navigation from "../../molecules/navigation/navigation.molecule";
import Header from "../../organisms/header/header.organism";
import Footer from "../../organisms/footer/footer.organism";

export default class HomeTemplate {
  constructor(pageParams) {
    this.pageParams = pageParams;
    this.templateParams = {
      templateName: "home",
    };
    this.NAVIGATION = new Navigation(this.pageParams, this.templateParams);
    this.HEADER = new Header(this.pageParams, this.templateParams);
    this.FOOTER = new Footer(this.pageParams, this.templateParams);
  }
}
