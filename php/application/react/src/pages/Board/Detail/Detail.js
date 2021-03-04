import React, { Component } from "react";
import CustomNavbar from "../../../Components/CustomNavbar";
import BoardDetail from '../../../Components/Board/BoardDetail'

class Detail extends Component {
  constructor(props) {
    super(props);
  }
  componentDidMount() {}
  render() {
    return (
      <>
        <CustomNavbar mClass="menu_four hosting_menu" nClass="w_menu" slogo="sticky_logo" />
        <BoardDetail/>
      </>
    );
  }
}
export default Detail;
