import React, { Component } from "react";
import CustomNavbar from "../../Components/CustomNavbar";
import HostingBanner from "../../Components/Banner/HostingBanner";
import HostingPlan from "../../Components/Features/HostingPlan";

import RestaurantInfo from "../../Components/info/RestaurantInfo";
class HomeHosting extends Component {
  constructor(props) {
    super(props);
    window.localStorage.setItem("mapValue", false);
    var ob = new RestaurantInfo();
  }
  componentDidMount() {}
  render() {
    return (
      <div className="body_wrapper">
        <CustomNavbar mClass="menu_four hosting_menu" nClass="w_menu" slogo="sticky_logo" />
        <HostingBanner />
      </div>
    );
  }
}
export default HomeHosting;
