import { patterns } from "./patterns";

export const detectBrowser = () => {
  let browserProps = {
    name: null,
    version: null,
    os: null,
    osVersion: null,
    touch: null,
    mobile: null,
  };

  let operatingSystem = "other";
  let osVersion = 0;
  let userAgent = navigator.userAgent;
  let i;

  for (i = 0; i < patterns.browsers.length; i++) {
    if (userAgent.match(patterns.browsers[i][1])) {
      operatingSystem = patterns.browsers[i][0];
      osVersion = parseFloat(RegExp.$1);
    }
  }

  for (
    browserProps.name = operatingSystem,
      browserProps.version = osVersion,
      operatingSystem = "other",
      osVersion = 0,
      i = 0;
    i < patterns.operatingSystem.length;
    i++
  ) {
    if (userAgent.match(patterns.operatingSystem[i][1])) {
      operatingSystem = patterns.operatingSystem[i][0];
      osVersion = parseFloat(
        patterns.operatingSystem[i][2]
          ? patterns.operatingSystem[i][2](RegExp.$1)
          : RegExp.$1
      );
    }
  }

  browserProps.os = operatingSystem;
  browserProps.osVersion = osVersion;
  browserProps.touch =
    "wp" == browserProps.os
      ? navigator.msMaxTouchPoints > 0
      : !!("ontouchstart" in window);
  browserProps.mobile =
    "wp" == browserProps.os ||
    "android" == browserProps.os ||
    "ios" == browserProps.os ||
    "bb" == browserProps.os;

  return browserProps;
};
