import {
  faLongArrowAltRight,
} from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import "@icon/themify-icons/themify-icons.css";
import React from 'react'

const Boxes = () => {
  return (
    <div className="icon-boxes">
      <div className="container-fluid">
        <div className="flex flex-wrap align-items-stretch">
          <div className="icon-box">
            <div className="icon">
              <span className="ti ti-world"></span>
            </div>

            <header className="entry-header">
              <h2 className="entry-title">Virtual imtihon</h2>
            </header>

            <div className="entry-content">
              <p>
                Lorem Ipsum available, but the majority have suffered alteration
                in some form, by injected humour.
              </p>
            </div>

            <footer className="entry-footer read-more">
              <a href="/">
                Ko'proq
                <FontAwesomeIcon icon={faLongArrowAltRight} className="fa" />
              </a>
            </footer>
          </div>
          <div className="icon-box">
            <div className="icon">
              <span className="ti ti-pencil-alt"></span>
            </div>

            <header className="entry-header">
              <h2 className="entry-title">Mavzuli testlar</h2>
            </header>

            <div className="entry-content">
              <p>
                Lorem Ipsum available, but the majority have suffered alteration
                in some form, by injected humour.
              </p>
            </div>

            <footer className="entry-footer read-more">
              <a href="/">
                Ko'proq
                <FontAwesomeIcon icon={faLongArrowAltRight} className="fa" />
              </a>
            </footer>
          </div>

          <div className="icon-box">
            <div className="icon">
              <span className="ti ti-book"></span>
            </div>

            <header className="entry-header">
              <h2 className="entry-title">Blokli testlar</h2>
            </header>

            <div className="entry-content">
              <p>
                Lorem Ipsum available, but the majority have suffered alteration
                in some form, by injected humour.
              </p>
            </div>

            <footer className="entry-footer read-more">
              <a href="/">
                Ko'proq
                <FontAwesomeIcon icon={faLongArrowAltRight} className="fa" />
              </a>
            </footer>
          </div>

          <div className="icon-box">
            <div className="icon">
              <span className="ti ti-bolt"></span>
            </div>

            <header className="entry-header">
              <h2 className="entry-title">Qiyin darajali testlar</h2>
            </header>

            <div className="entry-content">
              <p>
                Lorem Ipsum available, but the majority have suffered alteration
                in some form, by injected humour.
              </p>
            </div>

            <footer className="entry-footer read-more">
              <a href="/">
                Ko'proq
                <FontAwesomeIcon icon={faLongArrowAltRight} className="fa" />
              </a>
            </footer>
          </div>
        </div>
      </div>
    </div>
  );
}

export default Boxes
