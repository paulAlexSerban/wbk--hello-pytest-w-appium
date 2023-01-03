import Navigation from "../../molecules/navigation/navigation.molecule";
import Header from "../../organisms/header/header.organism";
import Footer from "../../organisms/footer/footer.organism";

export default class ProjectTemplate {
  constructor(parentPageParams) {
    this.templateParams = {
      parentPageParams,
    };

    this.init();
  }

  setupMolecules() {
    document
      .querySelectorAll('[data-js-component="navigation"]')
      .forEach((molecule) => {
        this.NAVIGATION = new Navigation(
          molecule,
          this.pageParams,
          this.templateParams
        );
      });
  }

  setupOrganisms() {
    document
      .querySelectorAll('[data-js-component="header"')
      .forEach((organism) => {
        this.HEADER = new Header(
          organism,
          this.pageParams,
          this.templateParams
        );
      });

    document
      .querySelectorAll('[data-js-component="footer"]')
      .forEach((organism) => {
        this.FOOTER = new Footer(
          organism,
          this.pageParams,
          this.templateParams
        );
      });
  }

  init() {
    this.setupMolecules();
    this.setupOrganisms();
  }
}
