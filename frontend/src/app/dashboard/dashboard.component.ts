import { Component, OnInit } from '@angular/core';
import { ApiService } from '../api.service';
import {Policy} from "../policy";

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.css']
})
export class DashboardComponent implements OnInit {
  policies: Policy[];
  selectedPolicy: Policy = {id: null, number: null, amount: null};

  constructor(private apiService: ApiService) { }

  ngOnInit(): void {
    this.updateList()
  }

  updateList(){
    this.apiService.readPolicies().subscribe((policies: Policy[])=>{
      this.policies = policies;
      console.log(this.policies);
    })
  }

  createOrUpdatePolicy(form){
    if(this.selectedPolicy && this.selectedPolicy.id){
      form.value.id = this.selectedPolicy.id;
      this.apiService.updatePolicy(form.value).subscribe((policy: Policy)=>{
        this.updateList();
        this.selectedPolicy = new Policy();
        console.log("Policy updated" , policy);
      });
    }
    else{
      this.apiService.createPolicy(form.value).subscribe((policy: Policy) => {
        this.updateList();
        console.log("Policy created, ", policy);
      });
    }

  }

  submitButton() {
    if (!this.selectedPolicy.id) {
      return 'Create';
    } else {
      return 'Update';
    }
  }

  selectPolicy(policy: Policy){
    this.selectedPolicy = policy;
  }

  deletePolicy(id){
    this.apiService.deletePolicy(id).subscribe((policy: Policy) => {
      this.updateList();
      console.log("Policy deleted, ", policy);
    });
  }
}
