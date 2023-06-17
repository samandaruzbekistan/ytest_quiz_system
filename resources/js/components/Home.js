import React from "react";
import { Link, NavLink } from "react-router-dom";
import "bootstrap/dist/css/bootstrap.min.css";

import {
  faPhone,
  faSearch,
} from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";

const Home = () => {
  return (
    <div className="hero-content">
      <header className="site-header">
        <div className="top-header-bar">
          <div className="container-fluid">
            <div className="row">
              <div className="col-12 col-lg-6 d-none d-md-flex flex-wrap justify-content-center justify-content-lg-start mb-3 mb-lg-0">
                <div className="header-bar-email d-flex align-items-center">
                  <i className="fa fa-envelope"></i>
                  <a href="/">Barcha fanlardan testlar</a>
                </div>

                <div className="header-bar-text lg-flex align-items-center">
                  <p>
                    <FontAwesomeIcon icon={faPhone} /> +998 90 123 45 67{" "}
                  </p>
                </div>
              </div>

              <div className="col-12 col-lg-6 d-flex flex-wrap justify-content-center justify-content-lg-end align-items-center">
                <div className="header-bar-search">
                  <form className="flex align-items-stretch">
                    <input type="search" placeholder="Izlash" />
                    <button
                      type="submit"
                      value=""
                      className="flex justify-content-center align-items-center"
                    >
                      <i>
                        <FontAwesomeIcon icon={faSearch} />
                      </i>
                    </button>
                  </form>
                </div>

                <div className="header-bar-menu">
                  <ul className="flex justify-content-center align-items-center py-2 pt-md-0">
                    <li>
                      <a href="/">Ro'yxatdan o'tish</a>
                    </li>
                    <li>
                      <a href="/">Kirish</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div className="nav-bar">
          <div className="container">
            <div className="row">
              <div className="col-9 col-lg-3">
                <div className="site-branding">
                  <h1 className="site-title">
                    <NavLink to="/">
                      Yong'oq<span>.uz</span>
                    </NavLink>
                  </h1>
                </div>
              </div>

              <div className="col-3 col-lg-9 flex justify-content-end align-content-center">
                <nav className="site-navigation flex justify-content-end align-items-center">
                  <ul className="flex flex-column flex-lg-row justify-content-lg-end align-content-center">
                    <li className="current-menu-item">
                      <NavLink
                        className={(navData) =>
                          navData.isActive ? "active" : ""
                        }
                        to="/tests"
                      >
                        Testlar
                      </NavLink>
                    </li>
                    <li>
                      <NavLink
                        className={(navData) =>
                          navData.isActive ? "active" : ""
                        }
                        to="/news"
                      >
                        Yangiliklar
                      </NavLink>
                    </li>
                    <li>
                      <NavLink
                        className={(navData) =>
                          navData.isActive ? "active" : ""
                        }
                        to="/about_us"
                      >
                        Biz haqimizda
                      </NavLink>
                    </li>
                    <li>
                      <NavLink
                        className={(navData) =>
                          navData.isActive ? "active" : ""
                        }
                        to="/contact"
                      >
                        Aloqa
                      </NavLink>
                    </li>
                  </ul>

                  <div className="hamburger-menu d-lg-none">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                  </div>

                  <div className="header-bar-cart">
                    <a
                      href="/"
                      className="flex justify-content-center align-items-center"
                    >
                      <span aria-hidden="true" className="icon_bag_alt"></span>
                    </a>
                  </div>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </header>

      <div className="hero-content-overlay">
        <div className="container">
          <div className="row">
            <div className="col-12">
              <div className="hero-content-wrap flex flex-column justify-content-center align-items-start">
                <header className="entry-header">
                  <h4>Biz bilan o'z bilimingni mustahkamlashni boshla</h4>
                  <h1>
                    Maqsad sari
                    <br />
                    yana bir qadam
                  </h1>
                </header>

                <div className="entry-content">
                  <p>
                    Excepteur sint occaecat cupidatat non proident, sunt in
                    culpa qui officia deserunt mollit anim id est laborum. Sed
                    ut perspiciatis unde omnis iste natus error sit voluptatem
                    accusantium doloremque laudantium
                  </p>
                </div>

                <footer className="entry-footer read-more">
                  <NavLink
                    className={(navData) => (navData.isActive ? "active" : "")}
                    to="/tests"
                  >
                    Boshlash
                  </NavLink>
                </footer>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Home;
