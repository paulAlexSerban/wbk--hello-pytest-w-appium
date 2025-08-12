from config import get_android_options
from driver_utils import initialize_driver
import time

options = get_android_options()
driver = initialize_driver(options)

driver.get("https://www.paulserban.eu")
print(driver.title)

time.sleep(5)
driver.quit()