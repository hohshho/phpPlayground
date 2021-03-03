import React, { Component } from "react";
import CustomNavbar from "../../../Components/CustomNavbar";
import HostingBanner from "../../../Components/Banner/HostingBanner";
import BoardList from '../../../Components/Board/BoardList'

class Main extends Component {
  constructor(props) {
    super(props);
  }
  componentDidMount() {}
  render() {
    return (
      <div className="body_wrapper">
        <CustomNavbar mClass="menu_four hosting_menu" nClass="w_menu" slogo="sticky_logo" />
        <BoardList/>
      </div>
    );
  }
}
export default Main;
