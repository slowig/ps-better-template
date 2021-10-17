import {render} from "@testing-library/vue";
import HelloWorld from "../components/HelloWorld";

describe("HelloWorld", () => {
  it("should show header with welcome message", async () => {
    const {getByText, getByRole, debug, updateProps} = render(HelloWorld, {
      props: {
        msg: "Hello Presta Template"
      }
    });
    expect(getByTestId("welcome-msg").textContent).toBe("Hello Presta Template");
  });
});
