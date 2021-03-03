import React, { Component } from "react";
import './Write.css';
import axios from "axios";
import { CKEditor } from '@ckeditor/ckeditor5-react';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

class Write extends Component {
  constructor(props) {
    super(props);
    this.state = {
        title: "",
        content: ""
    };
  }
  routeChange = () => {
    this.props.history.push("/login");
  };
  getValue = (e) => {
	const { value } = e.target;
    this.setState({ title: e.target.value });
  };
  onSubmit = async (e) => {
    e.preventDefault();
    let axiosResult = async () => {
        let send = await axios({
          method: "post",
          url: "http://localhost:80/update_user",
          data: {
            id: this.state.id,
            name: this.state.name,
            password: this.state.password,
            birth: this.state.birth,
            address: this.state.address
          },
        });
        return send;
    };
    // setTimeout(axiosResult, 1800);
    
  }
  componentDidMount() {}
  render() {
    return (
        <div className="App">
        <h1>HSH Board!</h1>
        <div className='form-wrapper'>
          <input className="title-input" type='text' placeholder='제목' onChange={ (e) => this.getValue(e) }/>
          <CKEditor
            editor={ClassicEditor}
            data="자유롭게 작성해주세요!"
            onReady={editor => {
              // You can store the "editor" and use when it is needed.
              console.log('Editor is ready to use!', editor);
            }}
            onChange={(event, editor) => {
              const data = editor.getData();
              console.log({ event, editor, data });
              this.setState({ content: data });
            }}
            onBlur={(event, editor) => {
              console.log('Blur.', editor);
            }}
            onFocus={(event, editor) => {
              console.log('Focus.', editor);
            }}
          />
        </div>
        <button onClick={this.routeChange} className="submit-button">Submit✅</button>
      </div>
    );
  }
}
export default Write;