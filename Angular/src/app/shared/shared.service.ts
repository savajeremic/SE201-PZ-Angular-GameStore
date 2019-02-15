import {Injectable} from "@angular/core";
import {Headers} from "@angular/http";
export const apiUrl = "http://localhost/gamedream/";

@Injectable()
export class SharedService {
  headers = new Headers();

  constructor() {
      this.headers.append('Content-Type', 'application/x-www-form-urlencoded');
      if (localStorage.getItem('token')) {
          this.headers.append('token', localStorage.getItem('token'));
      }
  }

  getHeaders(): Headers {
      return this.headers;
  }
}
