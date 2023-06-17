import React from "react";
import "@icon/themify-icons/themify-icons.css";

const AboutUs = () => {
  return (
    <>
      <div className="page-header-overlay">
        <div className="container">
          <div className="row">
            <div className="col-12">
              <header className="entry-header">
                <h1>ABOUT</h1>
              </header>
            </div>
          </div>
        </div>
      </div>

      <div className="container">
        <div className="row">
          <div className="col-12">
            <div className="about-heading">
              <h2 className="entry-title">Xush kelibsiz!</h2>

              <p>
                Excepteur sint occaecat cupidatat non proident, sunt in culpa
                qui officia deserunt mollit.
              </p>
            </div>
          </div>

          <div className="col-12 col-lg-6">
            <div className="about-stories">
              <h3>Biz haqimizda</h3>

              <p>
                Excepteur sint occaecat cupidatat non proident, sunt in culpa
                qui officia deserunt mollit anim id est laborum. Sed ut
                perspiciatis unde omnis iste natus error sit voluptatem
                accusantium.
              </p>

              <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                Pellentesque quis eros lobortis, vestibulum turpis ac, pulvinar
                odio.{" "}
              </p>

              <ul className="p-0 m-0 green-ticked">
                <li>Lorem ipsum dolor sit amet</li>
                <li>Lorem ipsum dolor sit amet</li>
                <li>Lorem ipsum dolor sit amet</li>
              </ul>
            </div>
          </div>

          <div className="col-12 col-lg-6">
            <div className="about-values">
              <h3>Biz haqimizda</h3>

              <p>
                Excepteur sint occaecat cupidatat non proident, sunt in culpa
                qui officia deserunt mollit anim id est laborum. Sed ut
                perspiciatis unde omnis iste natus error sit voluptatem
                accusantium.
              </p>

              <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                Pellentesque quis eros lobortis, vestibulum turpis ac, pulvinar
                odio.{" "}
              </p>

              <ul className="p-0 m-0 green-ticked">
                <li>Learning program with after-school</li>
                <li>Positive learning environment</li>
                <li>Learning through play</li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <section className="about-section">
        <div className="container">
          <div className="row">
            <div className="col-12 col-lg-6 align-content-lg-stretch">
              <header className="heading">
                <h2 className="entry-title">About Ezuca</h2>

                <p>
                  Excepteur sint occaecat cupidatat non proident, sunt in culpa
                  qui officia deserunt mollit anim id est laborum. Sed ut
                  perspiciatis unde omnis iste natus error sit voluptatem
                  accusantium.
                </p>
              </header>

              <div className="entry-content ezuca-stats">
                <div className="stats-wrap flex flex-wrap justify-content-lg-between">
                  <div className="stats-count">
                    50<span>M+</span>
                    <p>STUDENTS LEARNING</p>
                  </div>

                  <div className="stats-count">
                    30<span>K+</span>
                    <p>ACTIVE COURSES</p>
                  </div>

                  <div className="stats-count">
                    340<span>M+</span>
                    <p>INSTRUCTORS ONLINE</p>
                  </div>

                  <div className="stats-count">
                    20<span>+</span>
                    <p>Country Reached</p>
                  </div>
                </div>
              </div>
            </div>

            <div className="col-12 col-lg-6 flex align-content-center mt-5 mt-lg-0">
              <div className="ezuca-video position-relative">
                <div className="video-play-btn position-absolute">
                  <img src="../../images/video-icon.png" alt="Video Play" />
                </div>
                <img src="../../images/video-screenshot.png" alt="" />
              </div>
            </div>
          </div>
        </div>
      </section>

      <section className="testimonial-section">
        <div className="swiper-container testimonial-slider">
          <div className="swiper-wrapper">
            <div className="swiper-slide">
              <div className="container">
                <div className="row">
                  <div className="col-12 col-lg-6 order-2 order-lg-1 flex align-items-center mt-5 mt-lg-0">
                    <figure className="user-avatar">
                      <img src="../../images/user-1.jpg" alt="" />
                    </figure>
                  </div>

                  <div className="col-12 col-lg-6 order-1 order-lg-2 content-wrap h-100">
                    <div className="entry-content">
                      <p>
                        Together as teachers, students and universities we can
                        help make this education available for everyone.
                      </p>
                    </div>

                    <div className="entry-footer">
                      <h3 className="testimonial-user">
                        Russell Stephens - <span>University in UK</span>
                      </h3>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div className="swiper-slide">
            <div className="container">
              <div className="row">
                <div className="col-12 col-lg-6 order-2 order-lg-1 flex align-items-center mt-5 mt-lg-0">
                  <figure className="user-avatar">
                    <img src="../../images/user-2.jpg" alt="" />
                  </figure>
                </div>

                <div className="col-12 col-lg-6 order-1 order-lg-2 content-wrap h-100">
                  <div className="entry-content">
                    <p>
                      Excepteur sint occaecat cupidatat non proident, sunt in
                      culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                  </div>

                  <div className="entry-footer">
                    <h3 className="testimonial-user">
                      Robert Stephens - <span>University in Oxford</span>
                    </h3>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div className="swiper-slide">
            <div className="container">
              <div className="row">
                <div className="col-12 col-lg-6 flex order-2 order-lg-1 align-items-center mt-5 mt-lg-0">
                  <figure className="user-avatar">
                    <img src="../../images/user-3.jpg" alt="" />
                  </figure>
                </div>
                <div className="col-12 col-lg-6 order-1 order-lg-2 content-wrap h-100">
                  <div className="entry-content">
                    <p>
                      Lorem Ipsum available, but the majority have suffered
                      alteration in some form, by injected humour.
                    </p>
                  </div>

                  <div className="entry-footer">
                    <h3 className="testimonial-user">
                      James Stephens - <span>University in Cambridge</span>
                    </h3>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div className="container">
          <div className="row">
            <div className="col-12 col-lg-6 mt-5 mt-lg-0">
              <div className="swiper-pagination position-relative flex justify-content-center align-items-center"></div>
            </div>
          </div>
        </div>
      </section>

      <div className="container">
        <div className="row">
          <div className="col-12">
            <div className="team-heading">
              <h2 className="entry-title">Meet Our Team</h2>
              <p>
                Excepteur sint occaecat cupidatat non proident, sunt in culpa
                qui officia deserunt mollit.
              </p>
            </div>
          </div>

          <div className="col-12 col-md-6 col-lg-3">
            <div className="team-member">
              <img src="../../images/team-1.jpg" alt="" />

              <h3>Mr. John Wick</h3>
              <h4>Materials</h4>

              <ul className="p-0 m-0 d-flex justify-content-center align-items-center">
                <li>
                  <a href="/">
                    <span className="ti ti-facebook"></span>
                  </a>
                </li>
                <li>
                  <a href="/" className="ti ti-linkedin">
                    {/* <span className="ti ti-linkedin"></span> */}
                  </a>
                </li>
                <li>
                  <a href="/">
                    <span className="ti ti-instagram"></span>
                  </a>
                </li>
              </ul>
            </div>
          </div>

          <div className="col-12 col-md-6 col-lg-3">
            <div className="team-member">
              <img src="../../images/team-2.jpg" alt="" />

              <h3>Michelle Golden</h3>
              <h4>WordPress</h4>

              <ul className="p-0 m-0 d-flex justify-content-center align-items-center">
                <li>
                  <a href="/">
                    <span className="ti ti-facebook"></span>
                  </a>
                </li>
                <li>
                  <a href="/">
                    <span className="ti ti-linkedin"></span>
                  </a>
                </li>
                <li>
                  <a href="/">
                    <span className="ti ti-instagram"></span>
                  </a>
                </li>
              </ul>
            </div>
          </div>

          <div className="col-12 col-md-6 col-lg-3">
            <div className="team-member">
              <img src="../../images/team-3.jpg" alt="" />

              <h3>Ms. Lucius</h3>
              <h4>Data Analysis</h4>

              <ul className="p-0 m-0 d-flex justify-content-center align-items-center">
                <li>
                  <a href="/">
                    <span className="ti ti-facebook"></span>
                  </a>
                </li>
                <li>
                  <a href="/">
                    <span className="ti ti-linkedin"></span>
                  </a>
                </li>
                <li>
                  <a href="/">
                    <span className="ti ti-instagram"></span>
                  </a>
                </li>
              </ul>
            </div>
          </div>

          <div className="col-12 col-md-6 col-lg-3">
            <div className="team-member">
              <img src="../../images/team-4.jpg" alt="" />

              <h3>Ms. Lara Croft </h3>
              <h4>HTML CSS</h4>

              <ul className="p-0 m-0 d-flex justify-content-center align-items-center">
                <li>
                  <a href="/">
                    <span className="ti ti-facebook"></span>
                  </a>
                </li>
                <li>
                  <a href="/">
                    <span className="ti ti-linkedin"></span>
                  </a>
                </li>
                <li>
                  <a href="/">
                    <span className="ti ti-instagram"></span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </>
  );
};

export default AboutUs;
