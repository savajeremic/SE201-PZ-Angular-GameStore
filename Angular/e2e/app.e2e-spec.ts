import { IT255DZ12Page } from './app.po';

describe('it255-dz12 App', () => {
  let page: IT255DZ12Page;

  beforeEach(() => {
    page = new IT255DZ12Page();
  });

  it('should display message saying app works', () => {
    page.navigateTo();
    expect(page.getParagraphText()).toEqual('app works!');
  });
});
