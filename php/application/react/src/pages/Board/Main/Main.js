import React, { Component } from "react";
import CustomNavbar from "../../../Components/CustomNavbar";
import HostingBanner from "../../../Components/Banner/HostingBanner";
class Main extends Component {
  constructor(props) {
    super(props);
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
export default Main;
