import pytest
from config import get_android_options
from driver_utils import initialize_driver

@pytest.fixture
def driver():
    """Fixture to initialize and clean up the Appium driver."""
    options = get_android_options()
    driver = initialize_driver(options)
    yield driver
    driver.quit()

def test_website_title(driver):
    """Test to verify the website title."""
    driver.get("https://www.paulserban.eu")
    assert "Paul Serban" in driver.title